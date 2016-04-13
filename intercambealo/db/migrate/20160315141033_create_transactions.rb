class CreateTransactions < ActiveRecord::Migration
  def change
    create_table :transactions do |t|
      t.integer :product_req_id
      t.integer :product_offered_id
      t.integer :user_id
      t.string :state
      t.timestamps null: false
    end
  end
end
