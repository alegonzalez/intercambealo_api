class CreateProducts < ActiveRecord::Migration
	def change
		create_table :products do |t|
			t.integer :user_id
			t.string :name
			t.string :description
			t.string :state
			t.string :imagen
			t.timestamps null: false
		end
	end
end
