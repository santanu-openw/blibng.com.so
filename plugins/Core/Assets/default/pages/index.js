import auth from './+auth';
import home from './+home';
import contact from './+contact';
import gallery from './+gallery';
import pages from './+pages';
import booking from './+booking';
import profile from './+profile';

// https://developer.mozilla.org/pt-BR/docs/Web/JavaScript/Reference/Operators/Spread_operator
// Thus a new array is created, containing all objects that match the routes.
// ...dashboard must be the last one because of the catchall instruction
const Routes = [
    ...auth,
    ...home,
    ...contact,
    ...gallery,
    ...pages,
    ...booking,
    ...profile

];

Routes.map(route => {
    Zexus.routes.push(route)
});