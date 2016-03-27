class Transaction < ActiveRecord::Base
	validates :product_req_id, presence: {:message => "You must introduce a product req"}
    validates :product_offered_id, presence: {:message => "You must introduce a product offered"}   
end
