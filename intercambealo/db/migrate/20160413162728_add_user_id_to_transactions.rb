class AddUserIdToTransactions < ActiveRecord::Migration
  def change
  	 add_foreign_key :transactions, :users, column: :user_id, primary_key: 'id'
  end
end
