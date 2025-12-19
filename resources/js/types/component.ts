export type ComponentType = 'resistor' | 'capacitor' | 'microcontroller';

export interface Component {
  id: number;
  name: string;
  reference: string;
  type: ComponentType;
  description: string | null;
  stock_quantity: number;
  price: number;
  specifications: Record<string, any> | null;
  created_at: string;
  updated_at: string;
}

export interface PaginatedComponents {
  data: Component[];
  links: PaginationLink[];
  meta: PaginationMeta;
}

export interface PaginationLink {
  url: string | null;
  label: string;
  active: boolean;
}

export interface PaginationMeta {
  current_page: number;
  from: number;
  last_page: number;
  path: string;
  per_page: number;
  to: number;
  total: number;
}
