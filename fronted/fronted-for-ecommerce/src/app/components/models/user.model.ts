export interface User {
    id: string;
    name: string;
    email: string;
    phone?: string;
    address?: string;
    role: 'artisan' | 'buyer' | 'admin';
}
  