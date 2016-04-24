class UsersController < ApplicationController
 require 'time'
 require 'digest/md5' 
 before_action :set_users, only: [:destroy,:update]
 before_action :validate_token, only: [:create,:update,:destroy]
 skip_before_filter :verify_authenticity_token, only: [:create,:destroy,:authenticate,:update,:validate_token]
	#create a new user

	def create
		user = User.new(params_user)
		user.verificationUserNotRepit(user)

		if !user.errors{:username}.empty?
			render json:  user.errors, status: 422	
		else
			user.encryptionPassword(user)
			if user.save
				render nothing: true, status: 201
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
render json: {"Token" => user.token}, status: 200
else
 render json: {"Token" => user.errors}, status: 422
end
   #user.errors
 end

 def logout
  header = request.headers["Content-type"];
 
  render json:  header , status: 200 

   #token = User.new(params[:token])
   
 #user = JSON[token['token']]
 #render json: {"Error" => user}, status: 200
  # id= User.find_by(username: user['username'])

   #if id.update(:token => nil)
    # render nothing: true, status: 200 
   #else
   # render json: {"Error" => "Can't delete the session" }, status: 422
  #end

end 


#get token 
def getToken
  params.permit(:token)
end

   #validate the token 
   def validate_token
    #request.headers["token"]}
    puts "the token is"
    puts  request.headers["Content-type"]
    render json: request.headers["Content-type"]  ,status: 200
    #if(session[:token].nil?)
    #  render json: {"Message" => "Please Log"} ,status: 402
   # elsif (session[:expire] < Time.now)
   #   render json: {"Message" => "the session has expired, please log"} ,status: 402
   # else
    #  session[:expire] = Time.now + 30.minute
    #  user =  User.new
    #  user= session[:user]
    #  user['token'] = Time.now
    #  id= User.find_by(username: user['username'])
    #  id.update(:token => user['token'])
   # end 

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
