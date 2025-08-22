import { Routes } from '@angular/router';
// import { Layout } from './layout/layout';
import { Layout } from '../app/components/layout/layout';
import { Home } from '../app/components/home/home';
import { Categorias } from '../app/components/categorias/categorias';

export const routes: Routes = [

    {
        path: '',
        component:Layout,
        children:[
            {
                path: '',
                component:Home,
                title: 'Inicio'
            },
            {
                path: 'categorias',
                component:Categorias,
                title: 'categorias'
            }
        ]
    }
];
