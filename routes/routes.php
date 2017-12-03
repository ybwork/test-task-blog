<?php

return array(
	'admin/auction/delete' => 'controllers\admin\Auction/delete',
	'admin/auction/update' => 'controllers\admin\Auction/update',
	'admin/auction/edit/[0-9]+' => 'controllers\admin\Auction/edit', 
	'admin/auction/create' => 'controllers\admin\Auction/create',
	'admin/auctions' => 'controllers\admin\Auction/index',

	'admin/lot/delete' => 'controllers\admin\Lot/delete',
	'admin/lot/update' => 'controllers\admin\Lot/update',
	'admin/lot/edit/[0-9]+' => 'controllers\admin\Lot/edit', 
	'admin/lot/create' => 'controllers\admin\Lot/create',
	'admin/lots' => 'controllers\admin\Lot/index',

	'admin/user/delete' => 'controllers\admin\User/delete',
	'admin/user/update' => 'controllers\admin\User/update',
	'admin/user/edit/[0-9]+' => 'controllers\admin\User/edit',
	'admin/user/create' => 'controllers\admin\User/create',
	'admin/users' => 'controllers\admin\User/index',

	'login/user' => 'controllers\auth\Login/login',
	'logout' => 'controllers\admin\User/logout',
	'login' => 'controllers\auth\Login/index',

	'user/update' => 'controllers\site\User/update',

	'bet/create' => 'controllers\site\Bet/create',

	'auction/[0-9]+' => 'controllers\site\Auction/show',
	'auction/end' => 'controllers\site\Auction/end',

	'archive' => 'controllers\site\Archive/index',

	'' => 'controllers\site\Home/index',
);