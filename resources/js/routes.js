import Dashboard from './components/dashboard/Dashboard.vue';
import NotFound from './components/includes/NotFound.vue';

import Companys from './components/account-management/Companys.vue';
import AddPlayer from './components/account-management/AddPlayer.vue';
import PlayerList from './components/account-management/PlayerList.vue';

import ReferralName from './components/referral/ReferralName.vue';
import ReferralHistory from './components/referral/History.vue';
import ReferralTransaction from './components/referral/Transaction.vue';

import RakebackLimit from './components/rakeback/Limit.vue';
import RakebackHistory from './components/rakeback/History.vue';
import RakebackRunningBet from './components/rakeback/RunningBet.vue';

import ReportPlayerTransaction from './components/report/Transaction.vue';
import ReportPlayerRunningBet from './components/report/RunningBet';
import ReportPlayerWinLose from './components/report/WinLose.vue';
import ReportPlayerDaily from './components/report/Daily.vue';
import ReportPlayerMonth from './components/report/Monthly.vue';
import ReportPlayerhistoryCoin from './components/report/HistoryCoin.vue';
import ReportPlayerhistoryOperator from './components/report/HistoryOperator.vue';
import ReportPlayerJackport from './components/report/Jackpot.vue';
import ReportPlayerBonus from './components/report/Bonus.vue';

import ToolsMemo from './components/tools/Memo.vue';
import ToolsOnline from './components/tools/Online.vue';
import ToolsGame from './components/tools/GameControl.vue';
import ToolsStatistic from './components/tools/Statistic.vue';

import LogAgent from './components/log/Agent.vue';
import LogPlayer from './components/log/Player.vue';
import LogDownline from './components/log/Downline.vue';

import SystemLogActiviy from './components/system/log_activity/LogActivity.vue';
import SystemModules from './components/system/modules/Modules.vue';
import SystemRoles from './components/system/roles/Roles.vue';
import SystemUsers from './components/system/users/Users.vue';

export const routes = [{
        path: '*',
        component: NotFound,
        meta: { title: '', }
    }, {
        path: '/',
        component: Dashboard,
        meta: { title: 'Dashboard', path: ['Home'] }
    }, {
        path: '/dashboard',
        component: Dashboard,
        meta: { title: 'Dashboard', path: ['Home'] }
    }

    ,
    {
        path: '/companys',
        component: Companys,
        meta: { title: 'Companys', path: ['Home'] }
    }

    ,
    {
        path: '/player/create',
        component: AddPlayer,
        meta: { title: 'Add Player', path: ['Home', 'Account Management', 'Add Player'] }
    },
    {
        path: '/player/list',
        component: PlayerList,
        meta: { title: 'Player List', path: ['Home', 'Account Management', 'Player List'] }
    },
    {
        path: '/referral/list',
        component: ReferralName,
        meta: { title: 'List', path: ['Home', 'Referral', 'Referral Name'] }

    },
    {
        path: '/referral/history',
        component: ReferralHistory,
        meta: { title: 'History', path: ['Home', 'Referral', 'History'] }
    },
    {
        path: '/referral/transaction',
        component: ReferralTransaction,
        meta: { title: 'Transaction', path: ['Home', 'Referral', 'Transaction'] }
    }

    ,
    {
        path: '/rakeback/limit',
        component: RakebackLimit,
        meta: { title: 'Rakeback Limit', path: ['Home', 'Rakeback', 'Limit'] }
    },
    {
        path: '/rakeback/history',
        component: RakebackHistory,
        meta: { title: 'Rakeback History', path: ['Home', 'Rakeback', 'History'] }
    },
    {
        path: '/rakeback/running-bet',
        component: RakebackRunningBet,
        meta: { title: 'Running Bet', path: ['Home', 'Rakeback', 'Running Bet'] }
    }

    ,
    {
        path: '/report/player/transaction',
        component: ReportPlayerTransaction,
        meta: { title: 'Transaction', path: ['Home', 'Report', 'Transaction'] }
    },
    {
        path: '/report/player/running-bet',
        component: ReportPlayerRunningBet,
        meta: { title: 'Running Bet', path: ['Home', 'Report', 'Running-Bet'] }
    },
    {
        path: '/report/player/winlost',
        component: ReportPlayerWinLose,
        meta: { title: 'Report Win/Lost', path: ['Home', 'Report', 'Win-Lose'] }
    },
    {
        path: '/report/player/daily',
        component: ReportPlayerDaily,
        meta: { title: 'Daily Report', path: ['Home', 'Report', 'Daily-Report'] }
    },
    {
        path: '/report/player/month',
        component: ReportPlayerMonth,
        meta: { title: 'Month Report', path: ['Home', 'Report', 'Month-Report'] }
    },
    {
        path: '/report/player/history-coin',
        component: ReportPlayerhistoryCoin,
        meta: { title: 'History Coin', path: ['Home', 'Report', 'History-Coin'] }
    },
    {
        path: '/report/player/history-operator',
        component: ReportPlayerhistoryOperator,
        meta: { title: 'History Operator', path: ['Home', 'Report', 'History-Operator'] }
    },
    {
        path: '/report/player/jackport',
        component: ReportPlayerJackport,
        meta: { title: 'Jackport', path: ['Home', 'Report', 'Jackport'] }
    },
    {
        path: '/report/player/bonus',
        component: ReportPlayerBonus,
        meta: { title: 'Bonus', path: ['Home', 'Report', 'Bonus'] }
    }

    ,
    {
        path: '/tools/memo',
        component: ToolsMemo,
        meta: { title: 'Memo', path: ['Home', 'Tools', 'Memo'] }
    },
    {
        path: '/tools/online',
        component: ToolsOnline,
        meta: { title: 'Online', path: ['Home', 'Tools', 'Online'] }
    },
    {
        path: '/tools/game',
        component: ToolsGame,
        meta: { title: 'Game Controll', path: ['Home', 'Tools', 'Game-Controll'] }
    },
    {
        path: '/tools/statistic',
        component: ToolsStatistic,
        meta: { title: 'Statistic', path: ['Home', 'Tools', 'Statistic'] }
    }

    ,
    {
        path: '/log/agent',
        component: LogAgent,
        meta: { title: 'Agent Log', path: ['Home', 'Log', 'Agent'] }
    },
    {
        path: '/log/player',
        component: LogPlayer,
        meta: { title: 'Player Log', path: ['Home', 'Log', 'Player'] }
    },
    {
        path: '/log/downline',
        component: LogDownline,
        meta: { title: 'Downline Log', path: ['Home', 'Log', 'Downline'] }
    },

    ,
    {
        path: '/system/log_activity',
        component: SystemLogActiviy,
        meta: { title: 'Log activity', path: ['Home', 'System', 'Log activity'] }
    },

    {
        path: '/system/modules',
        component: SystemModules,
        meta: { title: 'Modules', path: ['Home', 'System', 'Modules'] }
    },

    {
        path: '/system/roles',
        component: SystemRoles,
        meta: { title: 'Roles', path: ['Home', 'System', 'Roles'] }
    },
    {
        path: '/system/users',
        component: SystemUsers,
        meta: { title: 'User list', path: ['Home', 'System', 'User'] }
    },
];