export default class OrderHelper {
    static calculateOrderPrice(order) {

        let price = 0;
        if (order.id) {
            if (order.services) {
                order.services.map(service => price += service.price);
            }

            if (order.package) {
                price = this.calculateOperation(price, order.package.m_operation, order.package.m_price);
            }
            if (order.plan) {
                price = this.calculateOperation(price, order.plan.m_operation, order.plan.m_price);
            }
            if (order.car_size) {
                price = this.calculateOperation(price, order.car_size.m_operation, order.car_size.m_price);
            }

        }


        return Number(price).toFixed(0);
    }

    static calculateOperation(total, operation, price) {
        switch (operation) {
            case "+":
                return total + price;
            case "-":
                return total - price;

            case "*":
                return total * price;

            case "/":
                return total / price;

            default :
                return total + price;
        }

    }

    static calculateServiceTime(order) {
        let time = 0;
        order.services.map(service => time += service.service_time);
        return time;
    }
}