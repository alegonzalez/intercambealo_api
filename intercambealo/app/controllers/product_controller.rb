class ProductController < ApplicationController

	before_action :getById ,only: [:update,:destroy,:show]

	#before_filter :validate_token, only: [:create,:update,:destroy,:show,:index,:search]

	skip_before_filter :verify_authenticity_token, only: [:create,:update,:destroy,:show,:index,:search,:validate_token]

	def index

		product = Product.where.not(user_id: params[:user_id])

		if product
			render json: product,status: 200
		else
			render json: product.errors.messages,status: 422
		end
	end

	def productUser

		product= Product.where(["user_id = :user_id and state = :state", { user_id: params[:user_id], state: "active" }])

		if product
			render json: product,status: 200
		else
			render json: product.errors.messages,status: 422
		end
		
	end


	def product_params
		params.permit(:user_id,:name,:description,:state,:imagen)
	end

	def create
		product = Product.new(product_params)
		respond_to do |format|
			if product.valid?
				product.save
				format.json {render json: product.valid?,status: 201}
			else
				format.json {render json: product.errors.messages,status: 422}
			end
		end
	end 

	def update
		@product.update(product_params)
		respond_to do |format|
			format.json {render json: @product,status: 200}
		end
	end

	def show
		product = Product.where(id: @product)
		respond_to do |format|
			format.json {render json: product,status: 200}
		end
	end

	def search
		product = Product.where(name:params[:name])

		respond_to do |format|
			format.json {render json: product,status: 200}
		end
	end


	def destroy
		@product.destroy
		
			render json: @product,status: 200
	end


	def getById
		@product = Product.find(params[:id])
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
