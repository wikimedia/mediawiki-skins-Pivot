<?php

use MediaWiki\Context\RequestContext;
use MediaWiki\Title\Title;
use MediaWiki\User\User;
use Wikimedia\TestingAccessWrapper;

/**
 * @covers PivotTemplate
 * @group Database
 */
class PivotTemplateIntegrationTest extends MediaWikiIntegrationTestCase {

	/**
	 * @dataProvider provideUsers
	 */
	public function testModernMenusRender( bool $registered ): void {
		$this->setMwGlobals( 'wgPivotFeatures', [] );
		$context = new RequestContext();
		$context->setTitle( Title::makeTitle( NS_MAIN, 'Pivot menu test' ) );
		$context->setUser( $registered ? $this->getTestUser()->getUser() : User::newFromId( 0 ) );
		$context->getOutput()->addCategoryLinks( [ 'Pivot test category' => '' ] );
		$skin = $this->getServiceContainer()->getSkinFactory()->makeSkin( 'pivot' );
		$skin->setContext( $context );
		$template = TestingAccessWrapper::newFromObject( $skin )->prepareQuickTemplate();
		$this->assertInstanceOf( PivotTemplate::class, $template );
		$navigation = $template->get( 'content_navigation' );
		foreach ( [
			'associated-pages', 'views', 'actions', 'variants',
			'user-page', 'user-interface-preferences', 'notifications', 'user-menu',
		] as $menu ) {
			$this->assertArrayHasKey( $menu, $navigation );
		}
		$this->assertArrayNotHasKey( 'namespaces', $navigation );
		$this->assertArrayNotHasKey( 'personal_urls', $template->data );
		$html = $template->getHTML();
		$this->assertStringContainsString( 'Pivot test category', $html );
		$this->assertStringContainsString( 'id="ca-talk"', $html );
		$this->assertStringContainsString( $registered ? 'id="pt-userpage"' : 'id="pt-login"', $html );
		$this->assertSame( 1, substr_count( $html, $registered ? 'id="pt-userpage"' : 'id="pt-login"' ) );
	}

	public static function provideUsers(): array {
		return [
			'anonymous' => [ false ],
			'registered' => [ true ],
		];
	}
}
