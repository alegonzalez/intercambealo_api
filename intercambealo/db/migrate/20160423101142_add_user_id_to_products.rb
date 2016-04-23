class AddUserIdToProducts < ActiveRecord::Migration
  def change
  	 add_foreign_key :products, :users, column: :user_id, primary_key: 'id'
  end
end
