<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Models\Children_details;
use App\Models\Pickedup_person_details;
use App\Models\Countries;
use App\Models\State;
use App\Models\City;
use DataTables;
use Carbon\Carbon;
use Intervention\Image\Facades\Image as Image;
//use Image;


class ChildrenRegisterController extends Controller
{

    public function register_form(){

        $data['countries'] = Countries::get(["name", "id"]);
        //dd($data);
        return view('pickedup_register',$data);
    }
    public function getState(Request $request)
    {
        $data['states'] = State::where("country_id", $request->country_id)->get(["name", "id"]);
        return response()->json($data);
    }
    public function getCity(Request $request)
    {
        $data['cities'] = City::where("state_id", $request->state_id)->get(["name", "id"]);
        return response()->json($data);
    }

    public function register_children_details_store(Request $request){
        //print_r($request->all());
        //  =============== Register children details & perents details start =========================

        $data =  $request->validate([
            'child_name' => 'required|string|unique:children_details,child_name',
            'birthday' => 'required|date|before:today|after:'.now()->subYears(100)->format('dd/mm/yyyy'),
            'class_name' => 'required|string',
            'address' => 'required|string|max:255',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'zip_code' => 'required|regex:/^[1-9]{1}[0-9]{2}\\s{0,1}[0-9]{3}$/',
            'child_photo' => 'required|image|mimes:jpg,jpeg,png|min:1024|dimensions:min_width=100,min_height=100',
            'person.*.name' => 'required|string|unique:pickedup_person_details,person_name',
            'person.*.relation' => 'required|string',
            'person.*.contact_no' => 'required|numeric|regex:/^([0-9\s\-\+\(\)]*)$/|digits_between:10,15',
    	],[
            'child_name.required' => 'Enter child name',
            'child_name.unique'=> 'This child name has already been taken',
            'birthday.required' => 'Please select child date of birth',
            'class_name.required' => 'Please select class',
            'class_name.regex' => 'The class field must contain only letters followed by 3 digits.',
            'address.required' => 'Enter your address',
            'country.required' => 'Select your country',
            'state.required' => 'Select your state',
            'city.required' => 'Select your city',
            'zip_code.required' => 'Enter your zip code',
    		'child_photo.required' => 'Upload child photo',
            'person.*.name.required' => 'The person name is required.',
            'person.*.name.unique'=> 'This person name has already been taken',
            'person.*.relation.required' => 'Select your person relation.',
            'person.*.contact_no.required' => 'The contact no is required.',
            'person.*.contact_no.min' => 'The contact no must be at least 10 degit.',
    	]);


        try {

                if ($request->hasFile('child_photo')) {

                    // $image = $request->file('child_photo');
                    // $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                    // $image->move(public_path('/upload/photo/'), $name_gen);
                    // $save_url = 'upload/photo/'.$name_gen;
                    //OR
                    $image = $request->file('child_photo');
                    $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                    Image::make($image)->resize(100,100)->save('upload/photo/'.$name_gen);
                    $save_url = 'upload/photo/'.$name_gen;

                    $child_id = Children_details::insertGetId([
                        'child_name' => $request->input('child_name'),
                        'date_of_birth' => $request->input('birthday'),
                        'class' => $request->input('class_name'),
                        'address' => $request->input('address'),
                        'country' =>$request->input('country') ,
                        'state' => $request->input('state'),
                        'city' => $request->input('city'),
                        'zip_code' => $request->input('zip_code'),
                        'child_photo' => $save_url,
                        'created_at' => Carbon::now(),
                    ]);

                           // ////////// Add Multiple Parents Start /////////
                    foreach ($data['person'] as $item) {
                                //print_r($item['name']);
                                $pickedup = new Pickedup_person_details();
                                $pickedup->child_id = $child_id;
                                $pickedup->person_name = $item['name'];
                                $pickedup->relation = $item['relation'];
                                $pickedup->contact_no = $item['contact_no'];
                                $pickedup->created_at = Carbon::now();
                                $pickedup->save();

                    }
                          // //////////Add Multiple Parents End /////////

                    if(!is_null($child_id)) {

                        return response()->json(['success' => true, 'message' => 'Child records registered Successfully']);

                    }else{
                        return response()->json(['error' => false, 'message' => 'Child records not registered']);
                    }

                }else{
                    return response()->json(['error' => false, 'message' => 'File not found.']);
                }


        }catch (\Exception $error) {

            return "Errors : ".$error->getMessage();

        }


        //  =============== Register children details & perents details end =========================

    }

    	// ====================================================== set index page view
    public function view_record(){

        $data['countries'] = Countries::get(["name", "id"]);
        //dd($data);
        return view('view_data_pickedup',$data);
    }


    // ==============================================handle fetch all Child ajax request

	public function fetchAll() {
		$childdata = Children_details::all();
		$output = '';
		if ($childdata->count() > 0) {
			$output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
                <tr>
                    <th>Sl No</th>
                    <th>Child Name</th>
                    <th>Date of Birth</th>
                    <th>Class</th>
                    <th>Address</th>
                    <th>Country</th>
                    <th>State</th>
                    <th>City</th>
                    <th>Zip Code</th>
                    <th>Child Photo</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';
            $count=1;
			foreach ($childdata as $child) {
                $country = Countries::find($child->country);
                $state = State::find($child->state);
                $city = City::find($child->city);

				$output .= '<tr>
                <td>' .$count++. '</td>
                <td>' . $child->child_name .'</td>
                <td>' . $child->date_of_birth . '</td>
                <td>' . $child->class . '</td>
                <td>' . $child->address . '</td>
                <td>' . $country->name . '</td>
                <td>' . $state->name . '</td>
                <td>' . $city->name . '</td>
                <td>' . $child->zip_code . '</td>
                <td><img src="'.$child->child_photo .'" width="80" class="img-thumbnail rounded-circle"></td>
                <td>
                  <a href="#" id="' . $child->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editChildModal"><i class="fas fa-edit"></i></a>

                  <a href="#" id="' . $child->id . '" class="text-danger mx-1 deleteIcon"><i class="fa fa-trash" aria-hidden="true"></i></a>
                </td>
              </tr>';
			}
			$output .= '</tbody></table>';
			echo $output;
		} else {
			echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
		}
	}



	//================================================ handle insert a new Children details ajax request

	public function store(Request $request) {

        $data =  $request->validate([
            'fname' => 'required|string|unique:children_details,child_name',
            'lname' => 'required|string|unique:children_details,child_name',
            'birthday' => 'required|date|before:today|after:'.now()->subYears(100)->format('dd/mm/yyyy'),
            'class_name' => 'required|string',
            'address' => 'required|string|max:255',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'zip_code' => 'required|regex:/^[1-9]{1}[0-9]{2}\\s{0,1}[0-9]{3}$/',
            'child_photo' => 'required|image|mimes:jpg,jpeg,png|min:1024|dimensions:min_width=100,min_height=100',
    	],[
            'fname.required' => 'Enter child first name',
            'lname.required' => 'Enter child last name',
            'fname.unique'=> 'This child name has already been taken',
            'lname.unique'=> 'This child name has already been taken',
            'birthday.required' => 'Please select child date of birth',
            'class_name.required' => 'Please select class',
            'class_name.regex' => 'The class field must contain only letters followed by 3 digits.',
            'address.required' => 'Enter your address',
            'country.required' => 'Select your country',
            'state.required' => 'Select your state',
            'city.required' => 'Select your city',
            'zip_code.required' => 'Enter your zip code',
    		'child_photo.required' => 'Upload child photo',
    	]);

        try {
              if ($request->hasFile('child_photo')) {

                $image = $request->file('child_photo');
                $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(100,100)->save('upload/photo/'.$name_gen);
                $save_url = 'upload/photo/'.$name_gen;

                $fullname = $request->input('fname').' '.$request->input('lname');

                $childData = ['child_name' => $fullname,'date_of_birth' => $request->input('birthday'),'class' => $request->input('class_name'),'address' => $request->input('address'),'country' =>$request->input('country') ,'state' => $request->input('state'),'city' => $request->input('city'),'zip_code' => $request->input('zip_code'),'child_photo' => $save_url,'created_at' => Carbon::now()];
                $insertdata = Children_details::create($childData);

                if(!is_null($insertdata)) {
                    return response()->json(['status' => 200, 'message' => 'Child records registered Successfully']);

                }else{
                    return response()->json(['status' => 401, 'message' => 'Child records not registered']);
                }


              }else{
                return response()->json(['error' => false, 'message' => 'File not found.']);
            }


        }catch (\Exception $error) {

            return "Errors : ".$error->getMessage();
        }


	}


	//================================================= handle edit an Children details ajax request

	public function edit(Request $request) {
		$id = $request->id;
		$child = Children_details::findOrFail($id);
        $countries = Countries::get();
        $states = State::where("country_id", $child->country)->get();
        $cities = City::where("state_id", $child->state)->get();

        $data = [
            'child' => $child,
            'countries' => $countries,
            'states' => $states,
            'cities' => $cities,
        ];
        //return response()->json($child);
		return response()->json($data);
	}


	// ===============================================handle update an Children details ajax request

	public function update(Request $request) {

        $data =  $request->validate([
            'fname' => 'required|string|unique:children_details,child_name',
            'lname' => 'required|string|unique:children_details,child_name',
            'birthday' => 'required|date|before:today|after:'.now()->subYears(100)->format('dd/mm/yyyy'),
            'class_name' => 'required|string',
            'address' => 'required|string|max:255',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'zip_code' => 'required|regex:/^[1-9]{1}[0-9]{2}\\s{0,1}[0-9]{3}$/',
            'new_child_photo' => 'image|mimes:jpg,jpeg,png|min:1024|dimensions:min_width=100,min_height=100',
    	],[
            'fname.required' => 'Enter child first name',
            'lname.required' => 'Enter child last name',
            'fname.unique'=> 'This child name has already been taken',
            'lname.unique'=> 'This child name has already been taken',
            'birthday.required' => 'Please select child date of birth',
            'class_name.required' => 'Please select class',
            'class_name.regex' => 'The class field must contain only letters followed by 3 digits.',
            'address.required' => 'Enter your address',
            'country.required' => 'Select your country',
            'state.required' => 'Select your state',
            'city.required' => 'Select your city',
            'zip_code.required' => 'Enter your zip code',
    	]);


        try {

            $save_url = '';
            $childdata = Children_details::find($request->child_id);

            if ($request->hasFile('new_child_photo')) {

                $image = $request->file('new_child_photo');
                $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(100,100)->save('upload/photo/'.$name_gen);
                $save_url = 'upload/photo/'.$name_gen;

                if ($childdata->child_photo) {
                    unlink($childdata->child_photo);
                }

            } else {
                $save_url = $request->old_child_photo;
            }

            $fullname = $request->input('fname').' '.$request->input('lname');
            $childData = ['child_name' => $fullname,'date_of_birth' => $request->input('birthday'),'class' => $request->input('class_name'),'address' => $request->input('address'),'country' =>$request->input('country'),'state' => $request->input('state'),'city' => $request->input('city'),'zip_code' => $request->input('zip_code'),'child_photo' => $save_url,'updated_at' => Carbon::now()];

            $updatedata = $childdata->update($childData);

            if(!is_null($updatedata)) {
                return response()->json(['status' => 200, 'message' => 'Child Details Updated Successfully!']);

            }else{
                return response()->json(['status' => 401, 'message' => 'Child records not Updated']);
            }


        }catch (\Exception $error) {

            return "Errors : ".$error->getMessage();
        }


	}



	//====================================== handle delete an Children details ajax request

	public function delete(Request $request) {

		$id = $request->id;
		$childData = Children_details::find($id);

		if ($childData->child_photo) {
            unlink($childData->child_photo);
			Children_details::destroy($id);
            Pickedup_person_details::where('child_id','=',$id)->delete();
		}
	}

}
