class Product < ActiveRecord::Base
    validates :name, presence: {:message => "You must introduce a name"}
    validates :descripcion, presence: {:message => "You must introduce a description"}  
    validates :state, presence: {:message => "You must introduce a state"}  
end
