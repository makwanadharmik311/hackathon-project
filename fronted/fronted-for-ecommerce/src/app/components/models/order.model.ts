import { CartItem } from "./cart.model";

export interface Order {
    id: string;
    userId: string;
    items: CartItem[];
    totalAmount: number;
    status: 'Pending' | 'Shipped' | 'Delivered' | 'Cancelled';
    paymentId: string;
    createdAt: Date;
}
  