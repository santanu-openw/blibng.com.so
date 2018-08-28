import auth from './+auth';
import home from './+home';
import accounts from './+accounts';
import pages from './+pages';
import blogs from './+blogs';
import translations from './+translations';
import contacts from './+contacts';
import partners from './+partners';
import testimonial from './+testimonial';
import gallery from './+gallery';

// https://developer.mozilla.org/pt-BR/docs/Web/JavaScript/Reference/Operators/Spread_operator
// Thus a new array is created, containing all objects that match the routes.
// ...dashboard must be the last one because of the catchall instruction
const Routes = [
    ...auth,
    ...home,
    ...accounts,
    ...pages,
    ...blogs,
    ...translations,
    ...contacts,
    ...partners,
    ...testimonial,
    ...gallery,
];

Routes.map(route => {
    Zexus.routes.push(route)
});