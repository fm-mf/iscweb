import Dashboard from './pages/Dashboard';
import Arrivals from './pages/Arrivals';
import Buddies from './pages/Buddies';
import Students from './pages/Students';
import Exports from './pages/Exports';
import History from './pages/History';

export default [
  { path: '/', component: Dashboard },
  { path: '/arrivals', component: Arrivals },
  { path: '/buddies', component: Buddies },
  { path: '/students', component: Students },
  { path: '/exports', component: Exports },
  { path: '/history', component: History }
];
