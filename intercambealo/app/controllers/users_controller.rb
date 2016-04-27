class UsersController < ApplicationController
 require 'time'
 require "base64"
 before_action :set_users, only: [:destroy,:update]
 before_action :validate_token, only: [:create,:update,:destroy]
 skip_before_filter :verify_authenticity_token, only: [:create,:destroy,:authenticate,:update]
	#create a new user

	def create
    user = User.new(params_user)
    user.verificationUserNotRepit(user)

    if !user.errors{:username}.empty?
      render json:  user.errors, status: 422	
    else
     user.encryptionPassword(user)
     if user.save

      render json:{"token" => user.token }, status: 201
    else
      render json: user.errors, status: 422
    end	
  end
end
    #update user
    def update
    	if @user.update(params_user)
    		render json: {"Message" => "Edit an specific user"},status: 200
    	else
    		render json: {"Message" => "The user can't edit"},status: 404
    	end
    end
  	#Delete users
  	def destroy
  		if @user.destroy
  			render json: {"Message" => "Deletes an specific user"}, status: 204
  		else
  			render json: {"Error" => "The user can't delete"}, status: 422
  		end
  	end

   #authenticate the user 
   def authenticate
   	user = User.new(params_authenticate)
   	user.valid_user_password(user)
   	if user.errors{:password}.empty? || user.errors{:username}.empty?
    # token = Time.now + 30.minute
    id = User.find_by(username: user.username)
    render json: {"Token" => user.token ,'User' => id}, status: 200
  else
    render json: {"Token" => user.errors}, status: 422
  end

end

def logout

 token = params[:token]
 id = params[:id]
 user= User.find_by(id: id)
 if(user.update(:token => nil))
  render nothing: true ,status: 200
else
 render json: user.errors, status: 422
end

end


   #validate the token 
   def validate_token
    token = params[:token]
    token = Base64.decode64(token)
    expire = Time.parse(token)
   #render json: {"Message1" => Time.now+ 1.minut,"Message2" => expire + 1.minute} ,status: 402      
   if (expire < Time.now)
    render json: {"Message" => "the session has expired, please log"} ,status: 402
    #if(token == nil)
     # render json: {"Message" => "Please Log"} ,status: 402
      #
       # 
     else
       token = Time.now + 1.minute
       

#    render json: {"Message" => token.localtime} ,status: 402   
     # render json: {"Message" => token} ,status: 402 
      #lal = Time.parse(token)
     # user =  User.new
     id = params[:id]
     id= User.find_by(id: id)
      #token = token.to_s
      #token = Base64.encode64(token)
      id.update(:token => token)
      id= User.find_by(id: id)
      #id.token = (id.token)
      #response.headers[''] = id.token

    end 

  end




    #get data the user 
    private
    def params_user
    	params.permit(:username,:password,:firstname,:token)
    end

    #Allow only the params indicated
    private 
    def params_authenticate
     params.require(:user).permit(:username,:password)
   end

    #search by id
    private 
    def set_users
    	@user = User.find(params[:id])
    end
  end

