<?php

use MediaWiki\Config\HashConfig;
use MediaWiki\Skin\SkinTemplate;
use Wikimedia\TestingAccessWrapper;

/**
 * @covers PivotTemplate
 */
class PivotTemplateTest extends MediaWikiUnitTestCase {

	private function newTemplate( array $navigation ): TestingAccessWrapper {
		$template = new PivotTemplate( new HashConfig() );
		$template->set( 'content_navigation', $navigation );
		$template->set( 'skin', $this->createMock( SkinTemplate::class ) );
		return TestingAccessWrapper::newFromObject( $template );
	}

	public function testRegisteredPersonalTools(): void {
		$template = $this->newTemplate( [
			'user-interface-preferences' => [ 'uls' => [ 'class' => 'uls-trigger' ] ],
			'user-page' => [ 'userpage' => [ 'href' => '/wiki/User:Example' ] ],
			'notifications' => [ 'notifications-alert' => [
				'href' => '/wiki/Special:Notifications',
				'link-class' => 'mw-echo-notifications-badge',
				'link-html' => '<span>3</span>',
				'active' => true,
			] ],
			'user-menu' => [
				'mytalk' => [ 'href' => '/wiki/User_talk:Example' ],
				'extension-link' => [ 'href' => '/wiki/Special:Example' ],
				'logout' => [ 'href' => '/wiki/Special:UserLogout' ],
			],
		] );
		$tools = $template->getPivotPersonalTools();
		$this->assertSame(
			[ 'uls', 'userpage', 'notifications-alert', 'mytalk', 'extension-link', 'logout' ],
			array_keys( $tools )
		);
		$this->assertSame( 'uls-trigger', $tools['uls']['links'][0]['class'] );
		$this->assertSame( 'pt-userpage', $tools['userpage']['id'] );
		$this->assertSame( '/wiki/User:Example', $tools['userpage']['links'][0]['href'] );
		$this->assertSame( 'pt-notifications-alert', $tools['notifications-alert']['id'] );
		$this->assertSame(
			'mw-echo-notifications-badge', $tools['notifications-alert']['links'][0]['class']
		);
		$this->assertSame( '<span>3</span>', $tools['notifications-alert']['links'][0]['link-html'] );
		$this->assertTrue( $tools['notifications-alert']['active'] );
	}

	public function testAnonymousPersonalTools(): void {
		$template = $this->newTemplate( [
			'user-interface-preferences' => [],
			'user-page' => [],
			'notifications' => [],
			'user-menu' => [
				'createaccount' => [ 'href' => '/wiki/Special:CreateAccount' ],
				'login' => [ 'href' => '/wiki/Special:UserLogin' ],
			],
		] );
		$tools = $template->getPivotPersonalTools();
		$this->assertSame( [ 'createaccount', 'login' ], array_keys( $tools ) );
		$this->assertSame( 'pt-login', $tools['login']['id'] );
	}

	public function testContentActionsExcludePersonalMenus(): void {
		$subject = [ 'id' => 'ca-nstab-user', 'href' => '/wiki/User:Example', 'class' => 'selected' ];
		$talk = [ 'id' => 'ca-talk', 'href' => '/wiki/User_talk:Example' ];
		$edit = [ 'id' => 'ca-edit', 'href' => '/wiki/User:Example?action=edit', 'tooltiponly' => true ];
		$extension = [ 'id' => 'custom-action', 'href' => '/wiki/Special:Example' ];
		$variant = [ 'id' => 'ca-varlang-zh-hans', 'href' => '/zh-hans/User:Example' ];
		$template = $this->newTemplate( [
			'associated-pages' => [ 'user' => $subject, 'user_talk' => $talk ],
			'views' => [
				'view' => [ 'id' => 'ca-view', 'redundant' => true ],
				'edit' => $edit,
			],
			'actions' => [
				'duplicate-edit' => [ 'id' => 'ca-edit', 'href' => '/wrong' ],
				'extension-action' => $extension,
			],
			'variants' => [ 'zh-hans' => $variant ],
			'user-interface-preferences' => [ 'uls' => [] ],
			'user-page' => [ 'userpage' => [] ],
			'notifications' => [ 'notifications-alert' => [] ],
			'user-menu' => [ 'logout' => [] ],
			'dock-bottom' => [ 'unrelated' => [] ],
		] );
		$this->assertSame( [
			'nstab-user' => $subject,
			'talk' => $talk,
			'edit' => $edit,
			'extension-action' => $extension,
			'varlang-zh-hans' => $variant,
		], $template->getPivotContentActions() );
	}
}
