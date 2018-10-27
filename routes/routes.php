<?php

return array(
	'admin/articles/delete' => 'controllers\admin\Article/delete',
	'admin/articles/update' => 'controllers\admin\Article/update',
	'admin/articles/edit/[0-9]+' => 'controllers\admin\Article/edit', 
	'admin/articles/create' => 'controllers\admin\Article/create',
	'admin/articles' => 'controllers\admin\Article/index',

	'login' => 'controllers\auth\Auth/login',
	'logout' => 'controllers\auth\Auth/logout',

	'' => 'controllers\site\Home/index',
);