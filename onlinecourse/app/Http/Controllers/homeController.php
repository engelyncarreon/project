<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class homeController extends Controller{

	// @return

	// public function __construct(){
	// 	$this->middleware('auth');
	// }

	@return	

	public function getPage(Request request){

		$pageshow = 6;

		if(isset($_GET["page"])){
			$page = $_GET["page"];
		}else{
			$page = 1;
		}

		$startfrom = ($page-1) * $pageshow;
		$show = DB::table('courses')
				->join('instructor')
				->select (DB::raw("CONCAT(instr_Firstname,' ',instr_lastName) AS instrName"))
				->whereIn('course_id', function($subQuery){
					$subQuery->select('course_id')->from('lessons')
				})
				->where('course_instr','=', 'instructor_id')
				->groupBy(1)
				->limit($startfrom,$pageshow)
				->get();
		// return $show;

				if(mysqli_num_rows($show)){
					$counter = 0;
					return "<div class = 'row'>";

					while($row=mysqli_fetch_array($show)){

						$lesson = DB::table('lessons')
								->select(*)
								->where('course_id','=','')

					}
				}

				return "<div class = 'col-sm-4 text-center'>
							<img class = 'img-responsive' src = '' alt='course-image>'
							<h3 id = 'title'>"

	}
	
}