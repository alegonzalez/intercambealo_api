class AddProductReqIdToTransactions < ActiveRecord::Migration
  def change
   add_foreign_key :transactions, :products, column: :product_req_id, primary_key: 'id'
  end
end
