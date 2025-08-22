import { Component } from '@angular/core';
import { Categorias } from '../categorias/categorias';

@Component({
  selector: 'app-home',
  imports: [Categorias],
  template: `<app-categorias />`,
  templateUrl: './home.html',
  styleUrl: './home.css'
})
export class Home {

}
