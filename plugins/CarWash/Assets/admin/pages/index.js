import products from './+products';

const Routes = [
    ...products
];

Routes.map(route => {
    Zexus.routes.push(route)
});