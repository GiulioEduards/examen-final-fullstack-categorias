import { Injectable } from '@angular/core';
import { environment } from '../../../environments/environment.development';
import { HttpClient } from '@angular/common/http';
import { Observable, map} from 'rxjs';
import { Categoria } from '../../../app/models/categoria.model';

 
@Injectable({
  providedIn: 'root'
})
export class CategoriasService {
  
  private base = environment.apiUrl;


  constructor(private http:HttpClient){

  }


  // listarCategorias(){
  //   return this.http.get(`${this.base}/categorias`);
  // }
  // crearCategorias(){
    
  // }
  // modificarCategorias(){
    
  // }
  // eliminarCategorias(){
    
  // }


    listarCategorias(): Observable<Categoria[]> {
    return this.http.get<Categoria[]>(`${this.base}/categoria`);
  }


  crearCategoria(categoria: Omit<Categoria, 'id'>): Observable<Categoria> {
    return this.http.post<Categoria>(`${this.base}/categoria`, categoria);
  }

  obtenerCategoriaPorId(id: number): Observable<Categoria> {
    return this.http.get<Categoria>(`${this.base}/categoria/${id}`);
  }

  modificarCategoria(id: number, categoria: Omit<Categoria, 'id'>): Observable<Categoria> {
  return this.http.put<Categoria>(`${this.base}/categoria/${id}`, categoria);
}
  // modificarCategoria(id: number, categoria: Categoria): Observable<Categoria> {
  //   return this.http.put<Categoria>(`${this.base}/categorias/${id}`, categoria);
  // }
  eliminarCategoria(id: number): Observable<void> {
    return this.http.delete<void>(`${this.base}/categoria/${id}`);
  }

}
