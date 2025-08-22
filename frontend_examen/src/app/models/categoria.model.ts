// src/app/models/categoria.model.ts
export interface Categoria {
  id: number;                // ID único
  name: string;            // Nombre de la categoría (ej: "Electrónicos")
  description: string;       // Descripción detallada
  image: string;        // URL de la imagen (opcional)
  fechaCreacion?: Date;      // Fecha de creación (opcional)
  activa?: boolean;          // Estado (activo/inactivo, opcional)
}