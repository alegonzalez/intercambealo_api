class TransactionController < ApplicationController

	before_action :getById , only: [:update,:destroy]
	#skip_before_filter :verify_authenticity_token, only: [:create,:index]

	def index
		transaction = Transaction.where(user_id: params[:user_id])

		if transaction
			render json: transaction,status: 200
		else
			render json: transaction.errors.messages,status: 422
		end	
	end


	def transaction_params
		params.permit(:product_req_id,:product_offered_id,:user_id, :state)
	end

	def create

		transaction = Transaction.new(transaction_params)
		if transaction.valid?
			transaction.save
			render json: transaction.valid?,status: 201
		else
			render json: transaction.errors.messages,status: 422
		end
		
	end 

	def update

		if @product.update(transaction_params)
			render json: @product,status: 200
		else
			render json: @product ,status: 200
		end		
	end


	def getById
		@product = Transaction.find(params[:id])
	end

	def destroy
		@product.destroy
		
		render json: @product,status: 200
	end


	def dateProduct

		id = (params[:user_id]);


		transaction =Transaction.joins("LEFT JOIN products ON transactions.product_offered_id=products.id and transactions.user_id =" + id + " or products.id = transactions.product_req_id and  transactions.user_id = "+id ).select("products.*,transactions.state, transactions.id as id_t")



		if transaction
			render json: transaction,status: 201
		else
			render json: transaction.errors.messages,status: 422
		end

	end


	def getNameProductReq

		user_id = params[:user_id];

		transaction = Transaction.joins("LEFT JOIN products ON transactions.product_offered_id=products.id").select("products.*, transactions.*").where( 'products.user_id = ? and transactions.state = ?',user_id , 'Pendiente')

		if transaction
			render json: transaction,status: 201
		else
			render json: transaction.errors.messages,status: 422
		end

	end


	def getNameProductOffer

		product_id = params[:product_id];

		transaction = Transaction.joins("LEFT JOIN products ON transactions.product_req_id=products.id").select("products.*").where('transactions.product_req_id' => product_id)

		if transaction
			render json: transaction,status: 201
		else
			render json: transaction.errors.messages,status: 422
		end

	end


end