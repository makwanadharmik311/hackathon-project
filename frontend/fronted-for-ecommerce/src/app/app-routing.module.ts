import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomeComponent } from './components/pages/home/home.component';
import { ProductListComponent } from './components/pages/product-list/product-list.component';
import { ProductDetailsComponent } from './components/pages/product-details/product-details.component';
import { CartComponent } from './components/pages/cart/cart.component';
import { OrderListComponent } from './components/pages/order-list/order-list.component';
import { LoginComponent } from './components/pages/login/login.component';
import { RegisterComponent } from './components/pages/register/register.component';


const routes: Routes = [
  { path: '', component: HomeComponent }, // Homepage
  { path: 'products', component: ProductListComponent }, // Product listing
  { path: 'product/:id', component: ProductDetailsComponent }, // Product details
  { path: 'cart', component: CartComponent }, // Shopping cart
  { path: 'orders', component: OrderListComponent }, // Order management
  { path: 'login', component: LoginComponent }, // Login
  { path: 'register', component: RegisterComponent }, // Register
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
