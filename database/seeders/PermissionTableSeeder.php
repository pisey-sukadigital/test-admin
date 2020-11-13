<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $permissions = [
            'dashboard',

            'account-managemnt',
            'player-create',
            'player-list',

            'referral',
            'referral-name',
            'referral-history',
            'referral-transaction',

            'rackback',
            'rackback-limit',
            'rackback-history',
            'rackback-running-bet',

            'report',
            'report-player-transaction',
            'report-running-bet',
            'report-win-lost',
            'report-daily-report-bet',
            'report-monthly',
            'report-history-coin',
            'report-history-operator',
            'report-jackport',
            'report-bonus',

            'tools',
            'tools-memo',
            'tools-online-list',
            'tools-game-control',
            'tools-statisic',

            'log',
            'log-agent',
            'log-player',
            'log-downline',

            'system',
            'system-users',
            'system-log-activity',
            'system-modules',
            'system-permission',
            'system-roles',

            'user-create',
            'user-edit',
            'user-delete',

            'role-list',
            'role-create',
            'role-edit',
            'role-delete'

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
