class TransactionController < ApplicationController

	before_action  only: [:create,:index]
	skip_before_filter :verify_authenticity_token, only: [:create,:index]

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
		params.permit(:product_req_id,:product_offered_id,:user_id, :state)
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