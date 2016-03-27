class TransactionController < ApplicationController

	def index
		transaction = Transaction.all
		respond_to do |format|
			if transaction
				format.json {render json: transaction,status: 200}
			else
				format.json {render json: transaction.errors.messages,status: 422}
			end
		end
	end


	def transaction_params
		params.permit(:product_req_id,:product_offered_id)
	end

	def create
		transaction = Transaction.new(transaction_params)
		respond_to do |format|
			if transaction.valid?
				transaction.save
				format.json {render json: transaction.valid?,status: 201}
			else
				format.json {render json: transaction.errors.messages,status: 422}
			end
		end
	end 



end