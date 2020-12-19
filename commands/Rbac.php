<?php

namespace app\commands;

use Yii;

class Rbac
{

    static function Init()
    {
        $auth = Yii::$app->authManager;

        // add "browse" permission
        $browse = $auth->createPermission('browse');
        $browse->description = 'Browse';
        $auth->add($browse);

        // add "edit" permission
        $edit = $auth->createPermission('edit');
        $edit->description = 'Edit';
        $auth->add($edit);

        // add "manage" permission
        $manage = $auth->createPermission('manage');
        $manage->description = 'Manage';
        $auth->add($manage);

        // add "author" role and give this role the "createPost" permission
        $user = $auth->createRole('user');
        $auth->add($user);
        $auth->addChild($user, $browse);

        // add "author" role and give this role the "createPost" permission
        $editor = $auth->createRole('editor');
        $auth->add($editor);
        $auth->addChild($editor, $edit);
        $auth->addChild($editor, $browse);

        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $manage);
        $auth->addChild($admin, $editor);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
         
        //$auth->assign($admin, 8);
        //$auth->assign($editor, 2);
        //$auth->assign($admin, 3);
    }

}