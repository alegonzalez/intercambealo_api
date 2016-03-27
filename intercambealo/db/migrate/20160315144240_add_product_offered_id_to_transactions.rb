class AddProductOfferedIdToTransactions < ActiveRecord::Migration
  def change
   add_foreign_key :transactions, :products, column: :product_offered_id, primary_key: 'id'

  end
end