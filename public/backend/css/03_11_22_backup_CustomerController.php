<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Controllers\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\Country;
use App\Models\State;
use App\Models\Product_type;
use App\Models\Product;
use App\Models\Orders;
use App\Models\Order_return_request;
use App\Models\Orders_details;
use App\Models\Shipping_Addresses;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Image;
//use Mail;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;



class CustomerController extends Controller
{
    public function customer_login(){

        return view('frontend.customer_login');
    }

     //============= Dashboard View ====================
     public function customer_dashboard(){

        $customer = array();

        if(Session::has('CustomerId')){
            $customer = Customer::where('id', '=', Session::get('CustomerId'))->first();
            //return $customer;
        }

       return view('frontend.dashboad.dashboard',compact('customer'));

    }
   //============= Dashboard View End ====================


//============= customer change password View ====================
    public function customer_change_password(){

        $customer = array();
        if(Session::has('CustomerId')){
            $customer = Customer::where('id', '=', Session::get('CustomerId'))->first();
            //return $customer;
        }

       return view('frontend.dashboad.change_password',compact('customer'));

    }
 //============= customer change password View end ====================

//============= customer order View ====================
    public function customer_order(){

        $customer = array();

        if(Session::has('CustomerId')){
            $customer = Customer::where('id', '=', Session::get('CustomerId'))->first();
            //return $customer;
        }

        $product_order = Orders::where("customers_id",$customer->id)->latest()->paginate(4);

       return view('frontend.dashboad.order' ,compact('customer', 'product_order'));

    }
//============= customer order View end ====================


// ======= order invoice start ====================
public function customer_order_invoice($id){

    $data = array();
    if(Session::has('CustomerId')){
        $customer = Customer::where('id', '=', Session::get('CustomerId'))->first();
        //return $customer;
    }

      $product_order = Orders::find($id);
      $product_order_details = Orders_details::where("order_id",$product_order->id)->get();

      $allOrderProduct =Orders_details::select('products.product_name','products.product_thambnail','products.product_code','products.short_description','orders_details.qty','orders_details.sale_price','orders_details.price')
                ->leftjoin('products','products.id','=','orders_details.product_id')
                ->where("order_id",$product_order->id)
                ->get();

    //return $allOrderProduct;
   return view('frontend.customer_invoice_order',compact('customer', 'product_order','allOrderProduct', 'allOrderProduct'));
}
// ======= order invoice End ====================

// ======= order view start ====================
public function customer_order_details($id){

   // echo "".$id;
   $data = array();
   if(Session::has('CustomerId')){
       $customer = Customer::where('id', '=', Session::get('CustomerId'))->first();
       //return $customer;
   }

    $product_order = Orders::find($id);
    $product_order_details = Orders_details::where("order_id",$product_order->id)->get();

    $allOrderProduct =Orders_details::select('orders_details.id','orders_details.order_id','orders_details.product_id','orders_details.has_product_return_request','products.product_name','products.product_slug','products.product_thambnail', 'products.product_code','products.short_description','orders_details.qty','orders_details.sale_price','orders_details.price')
                ->leftjoin('products','products.id','=','orders_details.product_id')
                ->where("order_id",$product_order->id)
                ->get();

    //return $allOrderProduct;
    return view('frontend.dashboad.customer_order_details',compact('customer', 'product_order','allOrderProduct', 'allOrderProduct'));
}
// ======= order view End ====================


  //======= Order Reason update start ===================
  public function customer_order_reason_update(Request $request)
  {

            $return_total_price = $request->sale_price*$request->product_qty;

            $order_return = Order_return_request::insert([
                'product_id'=> $request->product_id,
                'order_id' => $request->order_id,
                'order_details_id' => $request->order_detail_id,
                'product_name' => $request->product_name,
                "product_qty"=>$request->product_qty,
                "total_price"=>$return_total_price,
                "order_date"=>Carbon::now(),
                "return_reason"=>$request->return_reason,
                "return_status"=>'Pending',
                'created_at' => Carbon::now(),
            ]);

            //Customer details with shipping details & payment details
            $order = Orders::find($request->order_id);
            $order->has_return_request = 'yes';
            $order->save();

            // order details with product id, order id , qty, price & return request
            $order_details = DB::table('orders_details')->where('order_id', $request->order_id)->where('product_id', $request->product_id)->update(['has_product_return_request' => 'yes']);


            if(!is_null($order_return)) {

                $notification = array(
                    'message' => 'Order Return Request sent successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);

            }

  }
  //======= Order Reason update end ===================



//============= customer order return View ====================
public function customer_order_return(){

    $customer = array();

    if(Session::has('CustomerId')){
        $customer = Customer::where('id', '=', Session::get('CustomerId'))->first();
        //return $customer;
    }

    $product_order_return = Order_return_request::select('orders.customers_id','orders.name','order_return_requests.product_id','order_return_requests.order_id','order_return_requests.order_details_id','order_return_requests.product_name','order_return_requests.product_qty','order_return_requests.total_price','order_return_requests.order_date','order_return_requests.return_reason','order_return_requests.return_status')
                ->leftjoin('orders','orders.id','=','order_return_requests.order_id')
                ->where("customers_id",$customer->id)->paginate(4);
    //return $product_order_return;
   return view('frontend.dashboad.order_return_customer' ,compact('customer', 'product_order_return'));

}
//============= customer order return View end ====================



    //============= Customer Logout ====================
     public function customer_logout(){

        if(Session::has('CustomerId')){

            Session::pull('CustomerId');
            Session::pull('FRONT_USER_LOGIN');
            Session::pull('Frontend_User_Name');

            // session()->forget('ADMIN_LOGIN');
            // session()->forget('ADMIN_ID');

            $notification = array(
                'message' => 'Customer logout Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('login')->with($notification);
        }
    }
    //============= Customer Logout End====================

     //================= customer Login process Start ==============
     public function customer_login_process(Request $request){

        // echo "hello";
        // die;

        $request->validate(
            [
                'email'   =>  'required|email|regex:/(.+)@(.+)\.(.+)/i',
                'password' => 'required|min:5|max:25|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            ],[
                'email.required' => 'The valid email is required.',
                'password.required' => 'Enter your password',
                'password.min' => 'Enter minimum 5 digit password',
                'password.max' => 'Enter maximum 25 digit password',
                'password.regex' => 'The password format is invalid. [ Example Format: Raju@12345 ]',
            ]
        );

            $email = $request->email;
            $password = $request->password; //password: Raju@12345

            $customer = Customer::where('email', '=', $email)->first();
            //$db_dcptpassword = Crypt::decryptString($admin->password);

            //echo 'Password: '.$db_dcptpassword;
            //die;

        if($customer){

               $status = $customer->status;
               //$is_verify=$customer->is_verify;

                // if($is_verify==0){

                //         $notification = array(
                //             'message' => 'Please verify your email id',
                //             'alert-type' => 'warning'
                //         );
                //         return redirect()->route('login')->with($notification);
                //  }
                    if($status == 0){

                        $notification = array(
                            'message' => 'Your account has been deactivated',
                            'alert-type' => 'warning'
                        );
                        return redirect()->route('login')->with($notification);
                    }
                    else{

                            if(Hash::check($password, $customer->password)){

                                //get CustomerId , name
                                $request->session()->put('FRONT_USER_LOGIN',true);
                                $request->session()->put('CustomerId', $customer->id ); //FRONT_USER_ID
                                $request->session()->put('Frontend_User_Name',$customer->name);

                                $notification = array(
                                    'message' => 'Customer login Successfully',
                                    'alert-type' => 'success'
                                );
                                return redirect()->route('customer.dashboard')->with($notification);
                                //echo "Open Dashboard";

                            }else{

                                $notification = array(
                                    'message' => 'Password not matches',
                                    'alert-type' => 'warning'
                                );
                                return redirect()->route('login')->with($notification);
                            }

                    }



            }
         else{

                $notification = array(
                    'message' => 'Wrong Credentials',
                    'alert-type' => 'warning'
                );
                return redirect()->route('login')->with($notification);
           }



    }

    //================= customer Login process End ==============

    public function customer_registration(){

        return view('frontend.customer_registration');
    }

     //================= customer registration process Start ==============
     public function customer_registration_process(Request $request){

        // echo "hello";
        // die;
        $validator = validator::make($request->all(),[
                'firstname'=>'required',
                'lastname'=>'required',
                'email'=>'required|email|unique:customers,email',
                'mobile' => 'required|numeric|digits:10',
                'password' =>   'required|min:5|max:10|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            ],
            [

            'firstname.required' => 'Please enter your first name.',
            'lastname.required' => 'Please enter your last name.',
            'email.required' => 'Please enter your email.',
            'email.unique' => 'The email has already been registered.',
            'mobile.required' => 'Please enter your mobile number.',
            'password.required' => 'Enter your password',
            'password.min' => 'Enter minimum 5 digit password',
            'password.max' => 'Enter maximum 10 digit password',
        ]);

        $fullname = $request->firstname." ".$request->lastname;
        //echo "Name: ".$fullname;
        if($validator->passes())
        {
                $rand_id=rand(111111111,999999999);

                $customer = Customer::insert([
                    'name'=> $fullname,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'mobile' => $request->mobile,
                    "status"=>1,
                    "is_verify"=>0,
                    "rand_id"=>$rand_id,
                    "user_type"=>'registered_customer',
                    'created_at' => Carbon::now(),
                ]);

                if(!is_null($customer)) {

                    $data = [ 'subject' => "New Customer Registered", 'name' => $fullname, 'email' => $request->email, 'password' => $request->password, 'content' => 'Thank you for registered a customer account at POD.'];
                    Mail::send('frontend.mail_template.register_email_template', $data, function($message) use ($data) {
                        $message->to($data['email'])->subject($data['subject']);
                      });

                    return response()->json(['success'=>'Customer registered successfully.']);

                }
                else{

                    return response()->json(['warning'=>'Failed to register.']);
                }

        }

        return response()->json(['error'=>$validator->errors()]);


    }

    //================= customer registration process End ==============

    //============ Customer Profile Update Start ===================
    public function customer_profile_process(Request $request){

        $request->validate(
            [
                'firstname'=>'required',
                'lastname'=>'required',
                'email' =>  'required|email|regex:/(.+)@(.+)\.(.+)/i',
                'mobile' => 'required|numeric|digits:10',
                'profile_photo_path' => 'required|image|mimes:jpeg,jpg,png',
                'address'=>'required',
                'landmark'=>'required',
                'city'=>'required',
                'state'=>'required',
                'country'=>'required',
                'zip'=>'required',
		    ],[

                'firstname.required' => 'Please enter your first name.',
                'lastname.required' => 'Please enter your last name.',
                'email.required' => 'The valid email is required.',
                'mobile.required' => 'Please enter your mobile number.',
                'profile_photo_path.required' => 'The profile image is required.',
                'profile_photo_path.image' => 'The profile photo must be an image. such as: jpeg,jpg,png',
                'address.required' => 'Please enter your address.',
                'landmark.required' => 'Please enter your landmark.',
                'city.required' => 'Please enter your city.',
                'state.required' => 'Please enter your state.',
                'country.required' => 'Please enter your country.',
                'zip.required' => 'Please enter your zip / postal code.',
            ]
        );

        // $id = Auth::user()->id;
		// $customer = Admin::find($id);
        $customer = array();

        if(Session::has('CustomerId')){
            $customer = Customer::where('id', '=', Session::get('CustomerId'))->first();
            //return $customer;
        }

        $fullname = $request->firstname." ".$request->lastname;

		$customer->name = $fullname;
		$customer->email = $request->email;
        $customer->mobile = $request->mobile;
        $customer->address = $request->address;
        $customer->landmark = ucwords(strtolower($request->landmark));
        $customer->city = ucwords(strtolower($request->city));
        $customer->state = ucwords(strtolower($request->state));
        $customer->country = ucwords(strtolower($request->country));
        $customer->zip = $request->zip;
        $customer->company = $request->company;


		if ($request->file('profile_photo_path')) {

			$file = $request->file('profile_photo_path');
			@unlink(public_path('upload/customer_profile/'.$customer->profile_photo_path));
			$filename = date('YmdHi').$file->getClientOriginalName();
			$file->move(public_path('upload/customer_profile'),$filename);

			$customer['profile_photo_path'] = $filename;
		}

        $customer->save();

		$notification = array(
			'message' => 'Profile Updated Successfully',
			'alert-type' => 'success'
		);

		return redirect()->route('customer.dashboard')->with($notification);
    }

    //============Customer Profile Update End ===================

  //============= Customer change password update ====================
    public function customer_passwordchange_process(Request $request){

		$request->validate(
            [
                'oldpassword' => 'required|min:5|max:25|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
                'newpassword' => 'required|min:5|max:25|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
                'cmfmpassword' => 'required|required_with:password|same:newpassword|min:5|max:25|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
		    ],[

                'oldpassword.required' => 'Enter your old password',
                'oldpassword.min' => 'Enter minimum 5 digit password',
                'oldpassword.max' => 'Enter maximum 25 digit password',
                'oldpassword.regex' => 'The old password format is invalid. [ Example: Raju@12345 ]',

                'newpassword.required' => 'Enter your new password',
                'newpassword.min' => 'Enter minimum 5 digit password',
                'newpassword.max' => 'Enter maximum 25 digit password',
                'newpassword.regex' => 'The new password format is invalid. [ Example: Raju@12345  ]',

                'cmfmpassword.required' => 'Enter your confirm password',
                'cmfmpassword.required_with' => 'The password confirmation does not match.',
                'cmfmpassword.same' => 'The confirm password did not match with new password.',
                'cmfmpassword.min' => 'Enter minimum 5 digit password',
                'cmfmpassword.max' => 'Enter maximum 25 digit password',
                'cmfmpassword.regex' => 'The new password format is invalid. [ Example: Raju@12345  ]',
            ]
        );


        $old_password = $request->oldpassword;
        //echo "".$old_password;
        $customer = array();

        if(Session::has('CustomerId')){
            $customer = Customer::where('id', '=', Session::get('CustomerId'))->first();
            //return $customer;
        }

        //=================check old password======================
        if(Hash::check($old_password, $customer->password)){

            //echo "".$customer->password;
            // $customer = Customer::find(Auth::id());
			$customer->password = Hash::make($request->newpassword); //New password: Raju@1234
			$customer->save();

            $notification = array(
                'message' => 'Password has been changed successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('customer.change_password')->with($notification);
		}else{

            $notification = array(
                'message' => 'Incorrect password entered',
                'alert-type' => 'warning'
            );
            return redirect()->route('customer.change_password')->with($notification);
		}

	}
    //============= change password update End ====================



    //============= customer shipping address View list ====================
    public function customer_shipping(){

        $customer = array();

        if(Session::has('CustomerId')){
            $customer = Customer::where('id', '=', Session::get('CustomerId'))->first();
            //return $customer;
        }

        //$shipping_address_list = Shipping_Addresses::with('country_details','state_details')->get();
        //$parts = Parts::with('cars:id,name', 'bikes:id,name', 'formulas:id,name')->get();
        $shipping_address_list = Shipping_Addresses::where('user_id',Session::get('CustomerId'))->with(
            ['country_details' => function ($query) {
            $query->select('id', 'name');
        },
            'state_details' => function ($query) {
                $query->select('id', 'name');
            }
            ]
        )->get();
       //pr($shipping_address_list);

       return view('frontend.dashboad.address',compact('customer','shipping_address_list'));

    }
   //============= customer shipping address View list End ====================

   //============= customer shipping address form ====================
    public function customer_shippingaddress_addform(){

            $customer = array();

            if(Session::has('CustomerId')){
                $customer = Customer::where('id', '=', Session::get('CustomerId'))->first();
                //return $customer;
            }

            $countries = Country::where('status', 1)->get();

        return view('frontend.dashboad.add_shipping_address_form',compact('customer','countries'));

    }

    public function customer_shippingaddress_state($id){

        $customer = array();

        if(Session::has('CustomerId')){
            $customer = Customer::where('id', '=', Session::get('CustomerId'))->first();
            //return $customer;
        }

        $state = State::where('country_id',$id)->where('status', 1)->get();
        return response()->json($state);

    }
   //============= customer shipping address form End ====================


    //=============== Add shipping_address store Start ================
    public function customer_shipping_address_store(Request $request){

        $request->validate(
            [
                'name' => 'required',
                'phone' => 'required|numeric|digits:10',
                'address' => 'required',
                'landmark' => 'required',
                'country_id' => 'required',
                'state' => 'required',
                'city' => 'required',
                'pincode' => 'required',
            ],[

                'name.required' => 'Enter full name',
                'phone.required' => 'Enter mobile no',
                'address.required' => 'Enter shipping address',
                'landmark.required' => 'Enter shipping landmark',
                'country_id.required' => 'Select country name',
                'state.required' => 'Select state name',
                'city.required' => 'Enter city name',
                'pincode.required' => 'Enter pincode',
            ]
        );

        // $name = $request->all();
        // print_r($name);
        // print"<br>";
        // die;

        $customer_id = Session::get('CustomerId');
        $country_id = $request->country_id;

        $shipping_address_count = Shipping_Addresses::where('user_id',$customer_id)->count();

        if($shipping_address_count> 0){
            Shipping_Addresses::where('user_id',$customer_id)->update(['default' => 0]);
        }

        $shipping_addresses = Shipping_Addresses::insert([
            'user_id' => $customer_id,
            'name' => $request->name,
            'phone'=> $request->phone,
            'address'=> $request->address,
            'landmark'=> $request->landmark,
            'company'=> $request->company,
            'country' => $country_id,
            'state'=> $request->state,
            'city'=> $request->city,
            'zipcode'=> $request->pincode,
            'default' => 1,
            'created_at' => Carbon::now(),
        ]);

        if(!is_null($shipping_addresses)) {

            $notification = array(
                'message' => 'Shipping address inserted Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('customer.address')->with($notification);

        } else{

            $notification = array(
                'message' => 'Shipping address not inserted',
                'alert-type' => 'warning'
            );

            return redirect()->back()->with($notification);
        }


    }
    //=============== Add shipping address store End ================

    //=============== Edit shipping address details Start ================
    public function shipping_address_edit($id){

        $customer = array();

        if(Session::has('CustomerId')){
            $customer = Customer::where('id', '=', Session::get('CustomerId'))->first();
            //return $customer;
        }

    	$shipping_addresses = Shipping_Addresses::findOrFail($id);
        $countries = Country::where('status', 1)->get();
        $states = State::where("country_id", $shipping_addresses->country)->where('status', 1)->get();
        //return $countries;
        //return $shipping_addresses;
    	return view('frontend.dashboad.edit_shipping_address_form',compact('customer','countries','shipping_addresses','states'));

    }
    //=============== Edit shipping address details End ================

    //=============== Update shipping address Details Start ================
        public function shipping_address_update(Request $request)
        {

            $request->validate(
                [
                    'name' => 'required',
                    'phone' => 'required|numeric|digits:10',
                    'address' => 'required',
                    'landmark' => 'required',
                    'country_id' => 'required',
                    'state' => 'required',
                    'city' => 'required',
                    'pincode' => 'required',
                ],[

                    'name.required' => 'Enter full name',
                    'phone.required' => 'Enter mobile no',
                    'address.required' => 'Enter shipping address',
                    'landmark.required' => 'Enter shipping landmark',
                    'country_id.required' => 'Select country name',
                    'state.required' => 'Select state name',
                    'city.required' => 'Enter city name',
                    'pincode.required' => 'Enter pincode',
                ]
            );

                //return $request->all();
                $shipping_id = $request->id;
                $customer_id = Session::get('CustomerId');
                $country_id = $request->country_id;
                //return $shipping_id;

                $shipping_address = Shipping_Addresses::findOrFail($shipping_id)->update([
                    'user_id' => $customer_id,
                    'name' => $request->name,
                    'phone'=> $request->phone,
                    'address'=> $request->address,
                    'landmark'=> $request->landmark,
                    'company'=> $request->company,
                    'country' => $country_id,
                    'state'=> $request->state,
                    'city'=> $request->city,
                    'zipcode'=> $request->pincode,
                    'updated_at' => Carbon::now(),
                ]);

                if(!is_null($shipping_address)) {

                    $notification = array(
                    'message' => 'Shipping address updated Successfully',
                    'alert-type' => 'success'
                    );
                    return redirect()->route('customer.address')->with($notification);

                }
                else{

                        $notification = array(
                            'message' => 'Shipping address not updated',
                            'alert-type' => 'warning'
                        );

                        return redirect()->back()->with($notification);
                }

            }
    //=============== Update shipping address Details End ================


    //=============== Delete shipping address Details Start ==============
        public function shipping_address_delete($id){

            $shipping_addresses = Shipping_Addresses::findOrFail($id)->delete();

            if(!is_null($shipping_addresses)) {

                $notification = array(
                'message' => 'Shipping address deleted Successfully',
                'alert-type' => 'success'
                );
                return redirect()->route('customer.address')->with($notification);

            }else{

                $notification = array(
                    'message' => 'Shipping address not deleted',
                    'alert-type' => 'warning'
                );

                return redirect()->back()->with($notification);
            }

        }
    //============== Delete shipping address Details End ================



    //======== shipping address default change Start =================
        public function shipping_address_default_change($id)
        {

            $customer_id = Session::get('CustomerId');
            $shipping_address_count = Shipping_Addresses::where('user_id',$customer_id)->count();

            if($shipping_address_count> 0){
                Shipping_Addresses::where('user_id',$customer_id)->update(['default' => 0]);
            }


            $default_change = Shipping_Addresses::findOrFail($id)->update(['default' => 1]);

            if(!is_null($default_change)) {
                return response()->json(['success'=>'Default shipping address changed successfully..']);
            }
            else{
                return response()->json(['warning'=>'Default shipping addres not change.']);
            }


        }
    //======== shipping address default change End =================



}
