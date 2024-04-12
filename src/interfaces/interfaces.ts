export interface Category {
  id: number
  name: string
  parentId?: number
  subcategory?: Category[]
}

export interface Item {
  id: number
  name: string
  price: number
  description: string
  categoryId: number
  discount?: Discount
  discountedPrice?: number
}

export interface Discount {
  id: number
  name: string
  type: string // 'all_menu' | 'category' | 'subcategory' | 'item'
  value: number
  applicableId?: number
}
