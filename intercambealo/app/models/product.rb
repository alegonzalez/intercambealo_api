class Product < ActiveRecord::Base
	#attr_accessible :user_id,:name,:description,:state,:imagen
	validates :name, presence: {:message => "You must introduce a name"}
	validates :description, presence: {:message => "You must introduce a description"}  
	validates :state, presence: {:message => "You must introduce a state"}  
	#has_attached_file :imagen, styles:{medium: "200x200"}
	#validates_attachment_content_type :imagen, content_type: /\Aimage\/.*\z/
end
