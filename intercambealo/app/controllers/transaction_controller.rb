class TransactionController < ApplicationController

	before_action  only: [:create,:index]
	skip_before_filter :verify_authenticity_token, only: [:create,:index]

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

	def transactionPending

		id = (params[:user_id]);

		transaction =Transaction.joins("LEFT JOIN products ON transactions.product_offered_id=products.id").select("transactions.id,transactions.user_id").where("products.user_id" => id)

		if transaction
			render json: transaction,status: 201
		else
			render json: transaction.errors.messages,status: 422
		end

	end

	def dateProduct

		id = (params[:user_id]);


		transaction =Transaction.joins("LEFT JOIN products ON transactions.product_offered_id=products.id and transactions.user_id =" + id + " or products.id = transactions.product_req_id and  transactions.user_id = "+id ).select("products.*")



		if transaction
			render json: transaction,status: 201
		else
			render json: transaction.errors.messages,status: 422
		end

	end


	def getNameProductReq

		user_id = params[:user_id];

		transaction = Transaction.joins("LEFT JOIN products ON transactions.product_offered_id=products.id").select("products.*, transactions.*").where( 'products.user_id' => user_id)

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




	def validate_token

		if(session[:token].nil?)
			render json: {"Message" => "Please Log"} ,status: 402
		elsif (session[:expire] < Time.now)
			render json: {"Message" => "the session has expired, please log"} ,status: 402
		else
			session[:expire] = Time.now + 30.minute
			user =  User.new
			user= session[:user]
			user['token'] = Time.now
			id= User.find_by(username: user['username'])
			id.update(:token => user['token'])
		end 

	end

end