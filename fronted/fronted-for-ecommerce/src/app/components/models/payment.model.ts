export interface Payment{
    id: string;
    orderId: string;
    userId: string;
    amount: number;
    status: 'Success' | 'Pending' | 'Failed';
    transactionId: string;
    paymentGateway: 'Razorpay' | 'Stripe' | 'PayPal';
}
  