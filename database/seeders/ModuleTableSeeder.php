<?php

namespace Database\Seeders;

use App\Models\System\Module;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class ModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $modules = [

        ['dashboard','Dashborad', '/', 'fas fa-tachometer-alt', 0, 1, 1],
        ['account-managemnt','Account Managemnt', '#', 'fas fa-tachometer-alt', 0, 2, 1],
        ['referral','Referral', '#', 'fas fa-tachometer-alt', 0, 3, 1],
        ['rakeback','RackBack', '#', 'fas fa-tachometer-alt', 0, 4, 1],
        ['report','Report', '#', 'fas fa-tachometer-alt', 0, 5, 1],
        ['tools','Tools', '#', 'fas fa-tachometer-alt', 0, 6, 1],
        ['log','Log', '#', 'fas fa-tachometer-alt', 0, 7, 1],
        ['system','System', '#', 'fas fa-tachometer-alt', 0, 8, 1],

        ['company-list','Compant List', '/companys', 'fas fa-tachometer-alt', 2, 1, 1],
        ['player-create','Player Create', '/player/create', 'fas fa-tachometer-alt', 2, 2, 1],
        ['player-list','Player List', '/player/list', 'fas fa-tachometer-alt', 2, 3, 1],

        ['referral-name','Referral Name', '/referral/list', 'fas fa-tachometer-alt', 3, 1, 1],
        ['referral-history','History', '/referral/history', 'fas fa-tachometer-alt', 3, 2, 1],
        ['referral-transaction','Transaction', '/referral/transaction', 'fas fa-tachometer-alt', 3, 3, 1],

        ['rackback-limit','Rackback Limit', '/rakeback/limit', 'fas fa-tachometer-alt', 4, 1, 1],
        ['rackback-history','History', '/rakeback/history', 'fas fa-tachometer-alt', 4, 2, 1],
        ['rackback-running-bet','Running Bet', '/rakeback/running-bet', 'fas fa-tachometer-alt', 4, 3, 1],

        ['report-player-transaction','Player Transaction', '/report/player/transaction', 'fas fa-tachometer-alt',5,1,1],
        ['report-running-bet','Running Bet', '/report/player/running-bet', 'fas fa-tachometer-alt',5,2,1],
        ['report-win-lost','Win \ lose', '/report/player/winlost', 'fas fa-tachometer-alt',5,3,1],
        ['report-daily-report-bet','Daily Report', '/report/player/daily', 'fas fa-tachometer-alt',5,4,1],
        ['report-monthly','Monthly Report', '/report/player/month', 'fas fa-tachometer-alt',5,5,1],
        ['report-history-coin','History Coin', '/report/player/history-coin', 'fas fa-tachometer-alt',5,6,1],
        ['report-history-operator','History Operator', '/report/player/history-operator', 'fas fa-tachometer-alt',5,7,1],
        ['report-jackport','Jackport', '/report/player/jackport', 'fas fa-tachometer-alt',5,8,1],
        ['report-bonus','Bonus', '/report/player/bonus', 'fas fa-tachometer-alt',5,9,1],

        ['tools-memo','Memo', '/tools/memo', 'fas fa-tachometer-alt', 6, 1, 1],
        ['tools-online-list','Online List', '/tools/online', 'fas fa-tachometer-alt', 6, 2, 1],
        ['tools-game-control','Game Control', '/tools/game', 'fas fa-tachometer-alt', 6, 3, 1],
        ['tools-statisic','Statisic', '/tools/statistic', 'fas fa-tachometer-alt', 6, 4, 1],

        ['log-agent','Agent', '/log/agent', 'fas fa-tachometer-alt', 7, 1, 1],
        ['log-player','Player', '/log/player', 'fas fa-tachometer-alt', 7, 2, 1],
        ['log-downline','Downline', '/log/downline', 'fas fa-tachometer-alt', 7, 3, 1],

        ['system-users','Users', '/system/users', 'fas fa-tachometer-alt', 8, 1, 1],
        ['system-roles','Roles', '/system/roles', 'fas fa-tachometer-alt', 8, 2, 1],
        ['system-modules','Modules', '/system/modules', 'fas fa-tachometer-alt', 8, 3, 1],
        ['system-log-activity','Log Activity', '/system/log_activity', 'fas fa-tachometer-alt', 8, 4, 1],
        
        ];

        foreach ($modules as $module) {
            Module::create([
                'name' => $module[0],
                'display' => $module[1],
                'link' => $module[2],
                'symbol' => $module[3],
                'parent_id' => $module[4],
                'sort' => $module[5],
                'is_active' => $module[6],
            ]);
        }
    }
}
