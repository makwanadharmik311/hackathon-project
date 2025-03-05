export interface Product {
    id: string;
    name: string;
    description: string;
    price: number;
    imageUrl: string;
    arModelUrl?: string;  // For AR visualization
    category: string;
    artisanId: string;
    stock: number;
    certificationId?: string;  // Blockchain certification
}
  