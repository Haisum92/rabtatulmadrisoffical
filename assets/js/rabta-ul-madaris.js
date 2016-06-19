$(document).ready(function(e) {

    var base_url = "http://localhost/rabta-ul-madaris/"
     // alert('document is ready');
  //var numRegex = /^[0-9-]+$/;

  		$('#create_exam').bootstrapValidator({
			feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                'exam_name': {
                    validators: {
                        notEmpty: {
                            message: 'براہ مہربانی امتحان کا نام لکھیں-'
                        }
                    }
                },
                'exam_year_dominic': {
                    validators: {
                        notEmpty: {
                            message: 'براہ مہربانی امتحان کا سال لکھیں-'
                        },
                        stringLength: {
                                min: 4,
                                max: 4,
                                message: 'غلط سال کی انٹری'
                        },
                        regexp: {
                            regexp: /^[0-9]+$/,
                            message: 'غلط سال صرف نمبر داخل کریں'
                        }
                    }
                },
                'exam_year_hijri': {
                    validators: {
                        notEmpty: {
                            message: 'براہ مہربانی امتحان کا سال ہجری میں لکھیں-'
                        },
                        stringLength: {
                                min: 4,
                                max: 4,
                                message: 'غلط سال کی انٹری'
                        },
                        regexp: {
                            regexp: /^[0-9]+$/,
                            message: 'غلط سال کی انٹری'
                        }
                    }
                },
                'exam_result_date_dominic': {
                    validators: {
                        notEmpty: {
                            message: 'براہ مہربانی رزلٹ کی تاریخ عیسوی  میں منتخب کریں-'
                        }
                    }
                },
                'exam_result_date_hijri': {
                	validators: {
                		notEmpty: {
                			message: 'براہ مہربانی اس ناریخ کو رزلٹ کی تاریخ عیسوی سے منتخب کریں-'
                		}
                	}
                },
                'exam_degree_date_dominic': {
                	validators: {
                		notEmpty: {
                			message: 'براہ مہربانی تاریخ اجزاءاسنادعیسوی میں منتخب کریں-'
                		}
                	}
                },
                'exam_degree_date_hijri': {
                	validators: {
                		notEmpty: {
                			message: 'براہ مہربانی اس تاریخ کو تاریخ اجزاءاسناد عیسوی سے منتخب کریں-'
                		}
                	}
                },
                'exam_center': {
                	validators: {
                		notEmpty: {
                			message: 'براہ مہربانی دفتر کا نام لکھیں-'
                		}
                	}
                },
                'exam_type': {
                	validators: {
                		notEmpty: {
                			message: 'امتحان کی قسم منتخب کریں'
                		}
                	}
                }
            }

		});// end bootsrapvalidator function for register_form

        $('#edit_exam').bootstrapValidator({
            feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                'exam_name': {
                    validators: {
                        notEmpty: {
                            message: 'براہ مہربانی امتحان کا نام لکھیں-'
                        }
                    }
                },
                'exam_year_dominic': {
                    validators: {
                        notEmpty: {
                            message: 'براہ مہربانی امتحان کا سال لکھیں-'
                        },
                        stringLength: {
                                min: 4,
                                max: 4,
                                message: 'غلط سال کی انٹری'
                        },
                        regexp: {
                            regexp: /^[0-9]+$/,
                            message: 'غلط سال صرف نمبر داخل کریں'
                        }
                    }
                },
                'exam_year_hijri': {
                    validators: {
                        notEmpty: {
                            message: 'براہ مہربانی امتحان کا سال ہجری میں لکھیں-'
                        },
                        stringLength: {
                                min: 4,
                                max: 4,
                                message: 'غلط سال کی انٹری'
                        },
                        regexp: {
                            regexp: /^[0-9]+$/,
                            message: 'غلط سال صرف نمبر داخل کریں'
                        }
                    }
                },
                'exam_result_date_dominic': {
                    validators: {
                        notEmpty: {
                            message: 'براہ مہربانی رزلٹ کی تاریخ عیسوی  میں منتخب کریں-'
                        }
                    }
                },
                'exam_result_date_hijri': {
                    validators: {
                        notEmpty: {
                            message: 'براہ مہربانی اس ناریخ کو رزلٹ کی تاریخ عیسوی سے منتخب کریں-'
                        }
                    }
                },
                'exam_degree_date_dominic': {
                    validators: {
                        notEmpty: {
                            message: 'براہ مہربانی تاریخ اجزاءاسنادعیسوی میں منتخب کریں-'
                        }
                    }
                },
                'exam_degree_date_hijri': {
                    validators: {
                        notEmpty: {
                            message: 'براہ مہربانی اس تاریخ کو تاریخ اجزاءاسناد عیسوی سے منتخب کریں-'
                        }
                    }
                },
                'exam_center': {
                    validators: {
                        notEmpty: {
                            message: 'براہ مہربانی دفتر کا نام لکھیں-'
                        }
                    }
                },
                'exam_type': {
                    validators: {
                        notEmpty: {
                            message: 'امتحان کی قسم منتخب کریں'
                        }
                    }
                }
            }

        });// end bootsrapvalidator function for register_form

        $('#add_examination_center').bootstrapValidator({
            feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                'exam_center_name_urdu': {
                    validators: {
                        notEmpty: {
                            message: 'اس فیلڈ کا پر کرنا لازمی ہے'
                        }
                    }
                },
                'exam_province': {
                    validators: {
                        notEmpty: {
                            message: 'اس فیلڈ کا پر کرنا لازمی ہے'
                        }
                    }
                },
                'exam_center_district': {
                    validators: {
                        notEmpty: {
                            message: 'اس فیلڈ کا پر کرنا لازمی ہے'
                        }
                    }
                },
                'exam_center_address': {
                    validators: {
                        notEmpty: {
                            message: 'اس فیلڈ کا پر کرنا لازمی ہے'
                        }
                    }
                }
            }

        });// end bootsrapvalidator function for add_examination_center

        $("#exam_province").change(function(){

            objVal = $(this).val();
            
            // alert('Current Value is '+objVal+' and the base url is: '+base_url);
            // return false;
             // alert(objVal);return false;
            if(objVal == "" || objVal == "undefined")return false;

            // getting parent of the input
            var parent_city = $("#exam_center_district").parent();
            parent_city.prepend('<i class="fa fa-refresh fa-spin">');
            $("#exam_center_district").prop("disabled", true);

                $.ajax({
                    // the URL for the request
                    // url: "http://localhost/ARE-1/admin/get_company_and_service_types_by_company_type_ajax/",
                    url: base_url+"admin/getProvinceCitiesAjax/",
                    data: {prov_id: objVal},
                    type: "POST",
                    dataType : "html",
                    success: function( response ) {
                        // alert(response);return false;
                        var obj = jQuery.parseJSON(response);
                        // alert(obj.province[0].district_name_urdu);
                        // return false;
                        // alert('here'+ obj.cities_array.length);
                        // alert(obj.cities_array[1].ci_id);
                        // return false;
                        if (obj.cities_array != null) {
                            no_of_cities = obj.cities_array.length;
                                if (no_of_cities > 0) 
                                {
                                    $("#exam_center_district option").remove();
                                    $("<option></option>", {value: "", text: "--- شہر کا انتخا ب کریں ---",selected:"selected"}).appendTo('#exam_center_district');
                                    // $("<option></option>", {value: "", text: "Select Company",selected:"selected",disabled:"disabled"}).appendTo('#quantity_company');

                                    for (var i = 0; i < no_of_cities; i++) {
                                            
                                        $("<option></option>", {value: $.trim(obj.cities_array[i].d_id), text: $.trim(obj.cities_array[i].district_name_urdu)}).appendTo('#exam_center_district');

                                    }// end for loop for companies;   

                                    $("#exam_center_district").prop("disabled", false);

                                }else{

                                    $("#exam_center_district option").remove();
                                    $("<option></option>", {value: "", text: "کوئ شہر موجود نہیں",selected:"selected",disabled:"disabled"}).appendTo('#exam_center_district');
                                
                                }

                        }else{

                            $("#exam_center_district option").remove();
                            $("<option></option>", {value: "", text: "کوئ شہر موجود نہیں",selected:"selected",disabled:"disabled"}).appendTo('#exam_center_district');

                        }   // end if for obj.city != null
                        

                            // removing the spinners
                            parent_city.find(".fa-refresh").remove();
                    },
                    error: function( xhr, status, errorThrown ) {
                        alert( "Sorry, there was a problem!" );
                        console.log( "Error: " + errorThrown );
                        console.log( "Status: " + status );
                    },
                    complete: function( xhr, status ) {
                        //alert( "The request is complete!" );
                    }
            }); 
                        
        });// end blur function at add new examination center

        $('#edit_examination_center').bootstrapValidator({
            feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                'exam_center_name_urdu': {
                    validators: {
                        notEmpty: {
                            message: 'اس فیلڈ کا پر کرنا لازمی ہے'
                        }
                    }
                },
                // 'exam_center_name_eng': {
                //     validators: {
                //         notEmpty: {
                //             message: 'اس فیلڈ کا پر کرنا لازمی ہے'
                //         }
                //     }
                // },
                'exam_province': {
                    validators: {
                        notEmpty: {
                            message: 'اس فیلڈ کا پر کرنا لازمی ہے'
                        }
                    }
                },
                'exam_center_district': {
                    validators: {
                        notEmpty: {
                            message: 'اس فیلڈ کا پر کرنا لازمی ہے'
                        }
                    }
                },
                'exam_center_address': {
                    validators: {
                        notEmpty: {
                            message: 'اس فیلڈ کا پر کرنا لازمی ہے'
                        }
                    }
                }
            }

        });// end bootsrapvalidator function for edit_examination_center

        $("#institute_province").change(function(){

            objVal = $(this).val();
            
            // alert('Current Value is '+objVal+' and the base url is: '+base_url);
            // return false;
             // alert(objVal);return false;
            if(objVal == "" || objVal == "undefined")return false;

            // getting parent of the input
            var parent_city = $("#institute_district").parent();
            parent_city.prepend('<i class="fa fa-refresh fa-spin">');
            $("#institute_district").prop("disabled", true);

                $.ajax({
                    // the URL for the request
                    // url: "http://localhost/ARE-1/admin/get_company_and_service_types_by_company_type_ajax/",
                    url: base_url+"admin/getProvinceCitiesAjax/",
                    data: {prov_id: objVal},
                    type: "POST",
                    dataType : "html",
                    success: function( response ) {
                        // alert(response);return false;
                        var obj = jQuery.parseJSON(response);
                        // alert(obj.province[0].district_name_urdu);
                        // return false;
                        // alert('here'+ obj.cities_array.length);
                        // alert(obj.cities_array[1].ci_id);
                        // return false;
                        if (obj.cities_array != null) {
                            no_of_cities = obj.cities_array.length;
                                if (no_of_cities > 0) 
                                {
                                    $("#institute_district option").remove();
                                    $("<option></option>", {value: "", text: "--- شہر کا انتخا ب کریں ---",selected:"selected"}).appendTo('#institute_district');
                                    // $("<option></option>", {value: "", text: "Select Company",selected:"selected",disabled:"disabled"}).appendTo('#quantity_company');

                                    for (var i = 0; i < no_of_cities; i++) {
                                            
                                        $("<option></option>", {value: $.trim(obj.cities_array[i].d_id), text: $.trim(obj.cities_array[i].district_name_urdu)}).appendTo('#institute_district');

                                    }// end for loop for companies;   

                                    $("#institute_district").prop("disabled", false);

                                }else{

                                    $("#institute_district option").remove();
                                    $("<option></option>", {value: "", text: "کوئ شہر موجود نہیں",selected:"selected",disabled:"disabled"}).appendTo('#institute_district');
                                
                                }

                        }else{

                            $("#institute_district option").remove();
                            $("<option></option>", {value: "", text: "کوئ شہر موجود نہیں",selected:"selected",disabled:"disabled"}).appendTo('#institute_district');

                        }   // end if for obj.city != null
                        

                            // removing the spinners
                            parent_city.find(".fa-refresh").remove();
                    },
                    error: function( xhr, status, errorThrown ) {
                        alert( "Sorry, there was a problem!" );
                        console.log( "Error: " + errorThrown );
                        console.log( "Status: " + status );
                    },
                    complete: function( xhr, status ) {
                        //alert( "The request is complete!" );
                    }
            }); 
                        
        });// end blur function at add new examination center

        // FormValidation.Validator.password = {
        //     validate: function(validator, $field, options) {
        //         var value = $field.val();
        //         if (value === '') {
        //             return true;
        //         }

        //         if (value.length < 8) {
        //             return false;
        //         }
        //         if (value === value.toLowerCase()) {
        //             return false;
        //         }
        //         if (value === value.toUpperCase()) {
        //             return false;
        //         }
        //         if (value.search(/[0-9]/) < 0) {
        //             return false;
        //         }

        //         return true;
        //     }
        // };

        $('#affiliate_new_institute').bootstrapValidator({
            feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                'registration_no': {
                    validators: {
                        notEmpty: {
                            message: 'ادارہ کا رجسٹریشن نمبر لازمی ھے'
                        },
                        regexp: {
                            regexp: /^[0-9]+$/,
                            message: 'غلط رجسٹریشن نمبر'
                        },
                        remote: {
                                message: 'رجسٹریشن نمبر پہلے موجود ھے',
                                url: base_url + 'admin/validateRegisterationNoAjax',
                                type: 'POST'
                        }
                    }
                }
                // ,
                // 'affiliation_grade_l': {
                //     validators: {
                //         callback: {
                //             message: 'درجہ الحاق لازمی ھے',
                //             callback: function(value, validator) {
                //                 // Determine the numbers which are generated in captchaOperation
                //                  alert(value);
                //                  if (value == "grade2") {
                //                     var selVal = $("#class_grade_type").val();
                //                     alert(selVal);
                //                     // if( != ""){
                //                     //     return true;
                //                     // }else{
                //                     //     return false;        
                //                     // }
                //                     return true;
                //                  }
                                
                //             }
                //         }
                //     }
                // }
                ,
                'affiliation_grade': {
                    validators: {
                        notEmpty: {
                            message: 'درجہ الحاق لازمی ھے'
                        },
                        callback: {
                            message: 'درجہ الحاق لازمی ھے',
                            callback: function(value, validator, $field) {
                                // Determine the numbers which are generated in captchaOperation
                                 // alert(value+' 1');
                                 // alert($field);
                                 // alert($field.attr("name"));
                                 if (value != "" && value != null && value != "undefined") {
                                    // alert(value+'2');
                                    if (value == "grade2") {
                                        // alert(value+'3');
                                        var selVal = $("#class_grade_type").val();
                                        if (selVal == "" || selVal == null || selVal == "undefined") {
                                            // alert(value+'4');
                                            return false;
                                        }else{
                                            // alert(value+'5');
                                            return true;
                                        }
                                    }else{
                                        return true;
                                    }
                                 }else{
                                    // alert(value+'6');
                                    return false;
                                 }                                
                            }
                        }
                    }
                },
                'institute_full_name': {
                    validators: {
                        notEmpty: {
                            message: 'ادارہ کا مکمل نام لازمی ھے'
                        }
                    }
                },
                'institute_short_name': {
                    validators: {
                        notEmpty: {
                            message: 'ادارہ کا مختصر نام لازمی ھے'
                        }
                    }
                },
                'institute_owner_name': {
                    validators: {
                        notEmpty: {
                            message: 'مہتمم /ناظم کا نام لازمی ہے'
                        }
                    }
                },
                'institute_province': {
                    validators: {
                        notEmpty: {
                            message: 'ادارہ کا صوبہ لازمی ھے'
                        }
                    }
                },
                'institute_district': {
                    validators: {
                        notEmpty: {
                            message: 'ادارہ کا شہر لازمی ھے'
                        }
                    }
                },
                'institute_address': {
                    validators: {
                        notEmpty: {
                            message: 'ادارہ کا پتہ لازمی ھے'
                        }
                    }
                },
                'institute_phone_no': {
                    validators: {
                        notEmpty: {
                            message: 'ادارہ کا فون نمبر لازمی ھے'
                        }
                    }
                },
                'institute_mobile_no': {
                    validators: {
                        notEmpty: {
                            message: 'ادارہ کا موبائل نمبر لازمی ھے'
                        }
                    }
                },
                'date_of_affiliation': {
                    validators: {
                        notEmpty: {
                            message: 'تاریخ الحاق لازمی ھے'
                        }
                    }
                },
                'institute_affiliation_from': {
                    validators: {
                        notEmpty: {
                            message: 'ادارہ کی الحاق کا اغاز لازمی ھے'
                        }
                    }
                },
                'institute_affiliation_to': {
                    validators: {
                        notEmpty: {
                            message: 'ادارہ کا الحاق تا سال لازمی ہے'
                        }
                    }
                }
                
                
            }

        });// end bootsrapvalidator function for edit_examination_center


        /*$("#edit_exam_province").change(function(){

            objVal = $(this).val();
            
            // alert('Current Value is '+objVal+' and the base url is: '+base_url);
            // return false;
             // alert(objVal);return false;
            if(objVal == "" || objVal == "undefined")return false;

            // getting parent of the input
            var parent_city = $("#exam_center_district").parent();
            parent_city.prepend('<i class="fa fa-refresh fa-spin">');
            $("#exam_center_district").prop("disabled", true);

                $.ajax({
                    // the URL for the request
                    // url: "http://localhost/ARE-1/admin/get_company_and_service_types_by_company_type_ajax/",
                    url: base_url+"admin/getProvinceCitiesAjax/",
                    data: {prov_id: objVal},
                    type: "POST",
                    dataType : "html",
                    success: function( response ) {
                        // alert(response);return false;
                        var obj = jQuery.parseJSON(response);
                        // alert(obj.province[0].district_name_urdu);
                        // return false;
                        // alert('here'+ obj.cities_array.length);
                        // alert(obj.cities_array[1].ci_id);
                        // return false;
                        if (obj.cities_array != null) {
                            no_of_cities = obj.cities_array.length;
                                if (no_of_cities > 0) 
                                {
                                    $("#exam_center_district option").remove();
                                    $("<option></option>", {value: "", text: "--- شہر کا انتخا ب کریں ---",selected:"selected"}).appendTo('#exam_center_district');
                                    // $("<option></option>", {value: "", text: "Select Company",selected:"selected",disabled:"disabled"}).appendTo('#quantity_company');

                                    for (var i = 0; i < no_of_cities; i++) {
                                            
                                        $("<option></option>", {value: $.trim(obj.cities_array[i].ci_id), text: $.trim(obj.cities_array[i].district_name_urdu)}).appendTo('#exam_center_district');

                                    }// end for loop for companies;   

                                    $("#exam_center_district").prop("disabled", false);

                                }else{

                                    $("#exam_center_district option").remove();
                                    $("<option></option>", {value: "", text: "کوئ شہر موجود نہیں",selected:"selected",disabled:"disabled"}).appendTo('#exam_center_district');
                                
                                }

                        }else{

                            $("#exam_center_district option").remove();
                            $("<option></option>", {value: "", text: "کوئ شہر موجود نہیں",selected:"selected",disabled:"disabled"}).appendTo('#exam_center_district');

                        }   // end if for obj.city != null
                        

                            // removing the spinners
                            parent_city.find(".fa-refresh").remove();
                    },
                    error: function( xhr, status, errorThrown ) {
                        alert( "Sorry, there was a problem!" );
                        console.log( "Error: " + errorThrown );
                        console.log( "Status: " + status );
                    },
                    complete: function( xhr, status ) {
                        //alert( "The request is complete!" );
                    }
            }); 
                        
        });*/
        // end blur function at add new examination center

		// this piece of code is used when company logs in.
		$('#add_new_student').bootstrapValidator({
				
			feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                'exam_id': {
                    validators: {
                        notEmpty: {
                            message: 'امتحان کے انتخاب لازمی ہے.'
                        }
                    }
                },
                'course_grade': {
                    validators: {
                        notEmpty: {
                            message: 'کورس کے انتخاب لازمی ہے'
                        }
                    }
                }
            }

		});// end bootsrapvalidator function for login_form

        // this piece of code is used when company logs in.
        $('#edit_student_course').bootstrapValidator({
                
            feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                'exam_center': {
                    validators: {
                        notEmpty: {
                            message: 'امتحانی مرکز اس کو لکھنا لازمی ہے'
                        }
                    }
                },
                'name': {
                    validators: {
                        notEmpty: {
                            message: ' طالب علم کانام لازمی ہے'
                        }
                    }
                },
                'father_name': {
                    validators: {
                        notEmpty: {
                            message: 'والد کا نام لازمی ہے'
                        }
                    }
                },
                'id_card_no': {
                    validators: {
                        // notEmpty: {
                        //     message: 'شنا ختی کا رڈ نمبر لازمی ہے'
                        // },
                        regexp: {
                            regexp: /^[0-9+]{5}-[0-9+]{7}-[0-9]{1}$/,
                            message: 'شناختی نمبر درست نہیں ہے'
                        }
                    }
                },
                'dob_eng': {
                    validators: {
                        notEmpty: {
                            message: 'تاریخ پیدا ئش ہندسوں میں لازمی ہے'
                        }
                    }
                },
                // 'dob_urdu': {
                //     validators: {
                //         notEmpty: {
                //             message: 'تاریخ پیدا ئش حروف میں لازمی ہے'
                //         }
                //     }
                // },
                'old_institute_reg_no': {
                    verbose: false, // follow this link for furthur explanation http://formvalidation.io/validators/remote/
                    validators: {
                        notEmpty: {
                            message: 'انسٹی ٹیوٹ کے اندراج نمبر درکار ہے'
                        },
                        regexp: {
                            regexp: /^[0-9]+$/,
                            message: 'رجسٹریشن صرف اعداد میں'
                        },
                        remote: {
                                message: 'رجسٹریشن نمبر پہلے موجود نہیں ھے',
                                url: base_url + 'admin/validateRegisterationNoAjaxForEditStudent',
                                type: 'POST'
                        }
                    }
                },
                'address': {
                    validators: {
                        notEmpty: {
                            message: ' مستقل پتہ لازمی ہے'
                        }
                    }
                },
                'userfile': {
                    validators: {
                            file: {
                                extension: 'jpeg,JPEG,jpg,JPG,png,PNG,gif',
                                type: 'image/jpeg,image/png,image/gif',
                                maxSize: 2048 * 1024,
                                message: 'Only jpeg|JPEG|JPG|PNG|gif allowed'
                            }
                    }
                }

            }

        });// end bootsrapvalidator function for login_form

		$('#login_form').bootstrapValidator({
			feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                'email': {
                    validators: {
                        notEmpty: {
                            message: 'ای میل ایڈریس لازمی ہے'
                        },
                        regexp: {
							regexp: /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/,
							message: 'غلط ای میل ایڈریس'
						}
                    }
                },
                'password': {
                    validators: {
                        notEmpty: {
                            message: 'پاس ورڈ لازمی ہے'
                        }
                    }
                }

            }

		});// end bootsrapvalidator function for login_form

		$('#add-student-six-course').bootstrapValidator({
			feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                'exam_center': {
                    validators: {
                        notEmpty: {
                            message: 'امتحانی مرکز اس کو لکھنا لازمی ہے'
                        }
                    }
                },
                'class_name': {
                    validators: {
                        notEmpty: {
                            message: 'کلاس کا نام لازمی ہے'
                        }
                    }
                },
                'reg_no': {
                    validators: {
                        notEmpty: {
                            message: 'رجسٹریشن نمبر لازمی ہے'
                        }
                    }
                },
                'roll_no': {
                    validators: {
                        notEmpty: {
                            message: 'ر و ل نمبر لازمی ہے'
                        }
                    }
                },
                'name': {
                    validators: {
                        notEmpty: {
                            message: ' طالب علم کانام لازمی ہے'
                        }
                    }
                },
                'father_name': {
                    validators: {
                        notEmpty: {
                            message: 'والد کا نام لازمی ہے'
                        }
                    }
                },
                'id_card_no': {
                    validators: {
                        // notEmpty: {
                        //     message: 'شنا ختی کا رڈ نمبر لازمی ہے'
                        // },
                        regexp: {
							regexp: /^[0-9+]{5}-[0-9+]{7}-[0-9]{1}$/,
							message: 'شناختی نمبر درست نہیں ہے'
						}
                    }
                },
                'dob_eng': {
                    validators: {
                        notEmpty: {
                            message: 'تاریخ پیدا ئش ہندسوں میں لازمی ہے 06-05-1990'
                        }
                        /*,
                        regexp: {
                            regexp: /^(\d{4})-(\d{1,2})-(\d{1,2})$/,
                            message: 'تاریخ درست نہیں 06-05-1990'
                        } */  
                    }
                },
                // 'dob_urdu': {
                //     validators: {
                //         notEmpty: {
                //             message: 'تاریخ پیدا ئش حروف میں لازمی ہے'
                //         }
                //     }
                // }
                'old_institute_reg_no': {
                    validators: {
                        notEmpty: {
                            message: 'انسٹی ٹیوٹ کے اندراج نمبر درکار ہے'
                        },
                        regexp: {
                                regexp: /^[0-9]+$/,
                                message: 'رجسٹریشن صرف اعداد میں'
                        },
                        remote: {
                                message: 'رجسٹریشن نمبر پہلے موجود نہیں ھے',
                                url: base_url + 'admin/validateRegisterationNoAjaxForEditStudent',
                                type: 'POST'
                        }
                    }
                },
                'address': {
                    validators: {
                        notEmpty: {
                            message: ' مستقل پتہ لازمی ہے'
                        }
                    }
                },
                'userfile': {
                	validators: {
	                		file: {
		                        extension: 'jpeg,JPEG,jpg,JPG,png,PNG,gif',
		                        type: 'image/jpeg,image/png,image/gif',
		                        maxSize: 2048 * 1024,
		                        message: 'Only jpeg|JPEG|JPG|PNG|gif allowed'
		                    }
	                }
                }

            }

		});// end bootsrapvalidator function for login_form

		$('#add-student-hifz-course').bootstrapValidator({
			feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                'exam_center': {
                    validators: {
                        notEmpty: {
                            message: 'امتحانی مرکز اس کو لکھنا لازمی ہے'
                        }
                    }
                },
                'class_name': {
                    validators: {
                        notEmpty: {
                            message: 'کلاس کا نام لازمی ہے'
                        }
                    }
                },
                'reg_no': {
                    validators: {
                        notEmpty: {
                            message: 'رجسٹریشن نمبر لازمی ہے'
                        }
                    }
                },
                'roll_no': {
                    validators: {
                        notEmpty: {
                            message: 'ر و ل نمبر لازمی ہے'
                        }
                    }
                },
                'name': {
                    validators: {
                        notEmpty: {
                            message: ' طالب علم کانام لازمی ہے'
                        }
                    }
                },
                'father_name': {
                    validators: {
                        notEmpty: {
                            message: 'والد کا نام لازمی ہے'
                        }
                    }
                },
                'id_card_no': {
                    validators: {
                        // notEmpty: {
                        //     message: 'شنا ختی کا رڈ نمبر لازمی ہے'
                        // },
                        regexp: {
							regexp: /^[0-9+]{5}-[0-9+]{7}-[0-9]{1}$/,
							message: 'شناختی نمبر درست نہیں ہے'
						}
                    }
                },
                'dob_eng': {
                    validators: {
                        notEmpty: {
                            message: 'تاریخ پیدا ئش ہندسوں میں لازمی ہے'
                        }
                    }
                }
                ,
                // 'dob_urdu': {
                //     validators: {
                //         notEmpty: {
                //             message: 'تاریخ پیدا ئش حروف میں لازمی ہے'
                //         }
                //     }
                // },
                'old_institute_reg_no': {
                    validators: {
                        notEmpty: {
                            message: 'انسٹی ٹیوٹ کے اندراج نمبر درکار ہے'
                        },
                        regexp: {
                                regexp: /^[0-9]+$/,
                                message: 'رجسٹریشن صرف اعداد میں'
                        },
                        remote: {
                                message: 'رجسٹریشن نمبر پہلے موجود نہیں ھے',
                                url: base_url + 'admin/validateRegisterationNoAjaxForEditStudent',
                                type: 'POST'
                        }
                    }
                },
                'address': {
                    validators: {
                        notEmpty: {
                            message: ' مستقل پتہ لازمی ہے'
                        }
                    }
                },
                'userfile': {
                	validators: {
	                		file: {
		                        extension: 'jpeg,JPEG,jpg,JPG,png,PNG,gif',
		                        type: 'image/jpeg,image/png,image/gif',
		                        maxSize: 2048 * 1024,
		                        message: 'Only jpeg|JPEG|JPG|PNG|gif allowed'
		                    }
	                }
                }

            }

		});// end bootsrapvalidator add-student-hifz-course

		$('#add-student-ten-course').bootstrapValidator({
			feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                'exam_center': {
                    validators: {
                        notEmpty: {
                            message: 'امتحانی مرکز اس کو لکھنا لازمی ہے'
                        }
                    }
                },
                'class_name': {
                    validators: {
                        notEmpty: {
                            message: 'کلاس کا نام لازمی ہے'
                        }
                    }
                },
                'reg_no': {
                    validators: {
                        notEmpty: {
                            message: 'رجسٹریشن نمبر لازمی ہے'
                        }
                    }
                },
                'roll_no': {
                    validators: {
                        notEmpty: {
                            message: 'ر و ل نمبر لازمی ہے'
                        }
                    }
                },
                'name': {
                    validators: {
                        notEmpty: {
                            message: ' طالب علم کانام لازمی ہے'
                        }
                    }
                },
                'father_name': {
                    validators: {
                        notEmpty: {
                            message: 'والد کا نام لازمی ہے'
                        }
                    }
                },
                'id_card_no': {
                    validators: {
                        // notEmpty: {
                        //     message: 'شنا ختی کا رڈ نمبر لازمی ہے'
                        // },
                        regexp: {
							regexp: /^[0-9+]{5}-[0-9+]{7}-[0-9]{1}$/,
							message: 'شناختی نمبر درست نہیں ہے'
						}
                    }
                },
                'dob_eng': {
                    validators: {
                        notEmpty: {
                            message: 'تاریخ پیدا ئش ہندسوں میں لازمی ہے'
                        }
                    }
                }
                ,
                // 'dob_urdu': {
                //     validators: {
                //         notEmpty: {
                //             message: 'تاریخ پیدا ئش حروف میں لازمی ہے'
                //         }
                //     }
                // },
                'old_institute_reg_no': {
                    validators: {
                        notEmpty: {
                            message: 'انسٹی ٹیوٹ کے اندراج نمبر درکار ہے'
                        },
                        regexp: {
                                regexp: /^[0-9]+$/,
                                message: 'رجسٹریشن صرف اعداد میں'
                        },
                        remote: {
                                message: 'رجسٹریشن نمبر پہلے موجود نہیں ھے',
                                url: base_url + 'admin/validateRegisterationNoAjaxForEditStudent',
                                type: 'POST'
                        }
                    }
                },
                'address': {
                    validators: {
                        notEmpty: {
                            message: ' مستقل پتہ لازمی ہے'
                        }
                    }
                },
                'userfile': {
                	validators: {
	                		file: {
		                        extension: 'jpeg,JPEG,jpg,JPG,png,PNG,gif',
		                        type: 'image/jpeg,image/png,image/gif',
		                        maxSize: 2048 * 1024,
		                        message: 'Only jpeg|JPEG|JPG|PNG|gif allowed'
		                    }
	                }
                }

            }

		});// end bootsrapvalidator add-student-ten-course
		
		$('#add-student-tajweed-course').bootstrapValidator({
			feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                'exam_center': {
                    validators: {
                        notEmpty: {
                            message: 'امتحانی مرکز اس کو لکھنا لازمی ہے'
                        }
                    }
                },
                'class_name': {
                    validators: {
                        notEmpty: {
                            message: 'کلاس کا نام لازمی ہے'
                        }
                    }
                },
                'reg_no': {
                    validators: {
                        notEmpty: {
                            message: 'رجسٹریشن نمبر لازمی ہے'
                        }
                    }
                },
                'roll_no': {
                    validators: {
                        notEmpty: {
                            message: 'ر و ل نمبر لازمی ہے'
                        }
                    }
                },
                'name': {
                    validators: {
                        notEmpty: {
                            message: ' طالب علم کانام لازمی ہے'
                        }
                    }
                },
                'father_name': {
                    validators: {
                        notEmpty: {
                            message: 'والد کا نام لازمی ہے'
                        }
                    }
                },
                'id_card_no': {
                    validators: {
                        // notEmpty: {
                        //     message: 'شنا ختی کا رڈ نمبر لازمی ہے'
                        // },
                        regexp: {
							regexp: /^[0-9+]{5}-[0-9+]{7}-[0-9]{1}$/,
							message: 'شناختی نمبر درست نہیں ہے'
						}
                    }
                },
                'dob_eng': {
                    validators: {
                        notEmpty: {
                            message: 'تاریخ پیدا ئش ہندسوں میں لازمی ہے'
                        }
                    }
                }
                ,
                // 'dob_urdu': {
                //     validators: {
                //         notEmpty: {
                //             message: 'تاریخ پیدا ئش حروف میں لازمی ہے'
                //         }
                //     }
                // },
                'old_institute_reg_no': {
                    validators: {
                        notEmpty: {
                            message: 'انسٹی ٹیوٹ کے اندراج نمبر درکار ہے'
                        },
                        regexp: {
                                regexp: /^[0-9]+$/,
                                message: 'رجسٹریشن صرف اعداد میں'
                        },
                        remote: {
                                message: 'رجسٹریشن نمبر پہلے موجود نہیں ھے',
                                url: base_url + 'admin/validateRegisterationNoAjaxForEditStudent',
                                type: 'POST'
                        }
                    }
                },
                'address': {
                    validators: {
                        notEmpty: {
                            message: ' مستقل پتہ لازمی ہے'
                        }
                    }
                },
                'userfile': {
                	validators: {
	                		file: {
		                        extension: 'jpeg,JPEG,jpg,JPG,png,PNG,gif',
		                        type: 'image/jpeg,image/png,image/gif',
		                        maxSize: 2048 * 1024,
		                        message: 'Only jpeg|JPEG|JPG|PNG|gif allowed'
		                    }
	                }
                }

            }

		});// end bootsrapvalidator add-student-tajweed-course

		$("#dob_eng").blur(function(){
			
			objVal = $(this).val();
			if (objVal != "") {//alert(objVal);
			var dateSplitResult = objVal.split("-");
			// alert(dateSplitResult);
			var monthNames = {	'01':'جنوری','02':'فروری','03':'مارچ','04':'اپریل','05':'مئی','06':'جون',
								'07':'جولائی','08':'اگست','09':'ستمبر','10':'اکتوبر','11':'نومبر','12':'دسمبر'};
								//This Array For Getting Months With Integer
                                // console.log(dateSplitResult[1]);
			$('#dob_urdu').val((dateSplitResult[0]+" "+monthNames[dateSplitResult[1]]+" "+dateSplitResult[2]+" ء"));
			}else{
                //alert($("#dob_eng").val());
                //alert('here');
            }
			// alert(objVal);
			
		});// end blur function for Date of Birth English

        // $("#dob_eng").change(function(){
            
        //     objVal = $(this).val();
        //     if (objVal != "") {
        //     var dateSplitResult = objVal.split("-");
        //     alert(dateSplitResult)
        //     var monthNames = {  '01':'جنوری','02':'فروری','03':'مارچ','04':'اپریل','05':'مئی','06':'جون',
        //                         '07':'جولائی','08':'اگست','09':'ستمبر','10':'اکتوبر','11':'نومبر','12':'دسمبر'};
        //                         //This Array For Getting Months With Integer
        //     $('#dob_urdu').val((dateSplitResult[0]+" "+monthNames[dateSplitResult[1]]+" "+dateSplitResult[2]+" ء"));
        //     }
        //     // alert(objVal);
            
        // });// end blur function for Date of Birth English

        $('#account_edit_form').bootstrapValidator({
            feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                'password': {
                    validators: {
                        identical: {
                            field: 'confirm_password',
                            message: 'The password and its confirm are not the same'
                        },
                        stringLength: {
                                min: 5,
                                max: 5,
                                message: 'Password should not be less then or more then 5'
                        }

                    }
                },
                'confirm_password': {
                    validators: {
                        identical: {
                            field: 'password',
                            message: 'The password and its confirm are not the same'
                        }
                    }
                }
            }

        });// end bootsrapvalidator function for edit_account_form

        $('#add_province').bootstrapValidator({
            feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                'prov_name_urdu': {
                    validators: {
                        notEmpty: {
                            message: 'Province Name Urdu is required'
                        }
                    }
                },
                'prov_name_eng': {
                    validators: {
                        regexp: {
                            regexp: /[a-zA-Z ]/,
                            message: 'only aphabets allowed'
                        }
                    }
                }

            }

        });// end bootsrapvalidator function for add_province

        $('#edit_province').bootstrapValidator({
            feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                'prov_name_urdu': {
                    validators: {
                        notEmpty: {
                            message: 'Province Name Urdu is required'
                        }
                    }
                },
                'prov_name_eng': {
                    validators: {
                        regexp: {
                            regexp: /[a-zA-Z ]/,
                            message: 'only aphabets allowed'
                        }
                    }
                }

            }

        });// end bootsrapvalidator function for edit_province

        $('#add_city').bootstrapValidator({
            feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                'district_name_urdu': {
                    validators: {
                        notEmpty: {
                            message: 'City Name Urdu is required'
                        }
                    }
                },
                'district_province': {
                    validators: {
                        notEmpty: {
                            message: 'Province is required'
                        }
                    }
                }
            }

        });// end bootsrapvalidator function for add_city

        $('#edit_city').bootstrapValidator({
            feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                'district_name_urdu': {
                    validators: {
                        notEmpty: {
                            message: 'City Name Urdu is required'
                        }
                    }
                },
                'district_province': {
                    validators: {
                        notEmpty: {
                            message: 'Province is required'
                        }
                    }
                }
            }

        });// end bootsrapvalidator function for edit_province

        $('#add_class').bootstrapValidator({
            feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                'class_name_urdu': {
                    validators: {
                        notEmpty: {
                            message: 'Class Name in Urdu is required'
                        }
                    }
                },
                'class_name_eng': {
                    validators: {
                        notEmpty: {
                            message: 'Class name in english is required'
                        }
                    }
                },
                'class_type': {
                    validators: {
                        notEmpty: {
                            message: 'Class grade is required'
                        }
                    }
                }
            }

        });// end bootsrapvalidator function for add_class

        $('#add_subject').bootstrapValidator({
            feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                'sub_name_urdu': {
                    validators: {
                        notEmpty: {
                            message: 'مضمون کا نام لازمی ھے'
                        }
                    }
                },
                'total_marks': {
                    validators: {
                        notEmpty: {
                            message: 'نمبر لازمی ھے'
                        },
                        regexp: {
                            regexp: /^[0-9]+$/,
                            message: 'غلط نمبر'
                        }
                    }
                },
                'class_id': {
                    validators: {
                        notEmpty: {
                            message: 'کلاس لازمی ھے'
                        }
                    }
                }
            }

        });// end bootsrapvalidator function for add_subject

        $('#edit_subject').bootstrapValidator({
            feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                'sub_name_urdu': {
                    validators: {
                        notEmpty: {
                            message: 'مضمون کا نام لازمی ھے'
                        }
                    }
                },
                'total_marks': {
                    validators: {
                        notEmpty: {
                            message: 'نمبر لازمی ھے'
                        },
                        regexp: {
                            regexp: /^[0-9]+$/,
                            message: 'غلط نمبر'
                        }
                    }
                },
                'class_id': {
                    validators: {
                        notEmpty: {
                            message: 'کلاس لازمی ھے'
                        }
                    }
                }
            }

        });// end bootsrapvalidator function for add_subject

        $('#create_datesheet').bootstrapValidator({
            feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                'exam_id': {
                    validators: {
                        notEmpty: {
                            message: 'امتحان لازمی ھے'
                        }
                    }
                }
            }

        });// end bootsrapvalidator function for add_subject

        $('#date_sheet').bootstrapValidator({
            feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                'exam_id': {
                    validators: {
                        notEmpty: {
                            message: 'امتحان لازمی ھے'
                        }
                    }
                }
            }

        });// end bootsrapvalidator function for add_subject

        $('#ghazat_detail').bootstrapValidator({
            
            feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                'exam_id': {
                    validators: {
                        notEmpty: {
                            message: 'امتحان کا انتخاب لازمی ھے'
                        }
                    }
                },
                'exam_gender': {
                    validators: {
                        notEmpty: {
                            message: 'طلبہ یا طالبات لازمی ہے'
                        }
                    }
                }
            }

        });// end bootsrapvalidator function for ghazat_detail

        $('#edit_date_for_hifz_ul_quran').bootstrapValidator({

            feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                'hifzulquran_exam_date': {
                    validators: {
                        notEmpty: {
                            message: 'تاریخ کا انتخاب لازمی ھے'
                        }
                    }
                }
            }

        });// end bootsrapvalidator function for edit_date_for_hifz_ul_quran

        $('#edit_date_for_tajweed_ul_quran').bootstrapValidator({

            feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                'tajweedulquran_exam_date': {
                    validators: {
                        notEmpty: {
                            message: 'تاریخ کا انتخاب لازمی ھے'
                        }
                    }
                }
            }

        });// end bootsrapvalidator function for edit_date_for_tajweed_ul_quran

        $('#add_one_subject_result').bootstrapValidator({

            feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                'obtained_marks': {
                    validators: {
                        regexp: {
                            regexp: /^[0-9]+$/,
                            message: 'غلط نمبر'
                        },
                        between: {
                            min: 0,
                            max: 100,
                            message: 'نمبر صرف 0 سے ۱۰۰ کے درمین ہو سکتے ھیں'
                        }
                    }
                }
            }

        });// end bootsrapvalidator function for edit_date_for_tajweed_ul_quran

        $('#add_six_subject_result').bootstrapValidator({

            feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
            },
            fields: {

                'obtained_marks[]': {
                    validators: {
                        regexp: {
                            regexp: /^[0-9]+$/,
                            message: 'غلط نمبر'
                        },
                        between: {
                            min: 0,
                            max: 100,
                            message: 'نمبر صرف 0 سے ۱۰۰ کے درمین ہو سکتے ھیں'
                        }
                    }
                }
                // 
            }

        });// end bootsrapvalidator function for add_six_subject_result

        $('#marks_with_subject').bootstrapValidator({

            feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                'exam_id': {
                    validators: {
                        notEmpty:{
                            message: 'امتحان کا انتخاب لازمی ھے'
                        }
                    }
                },
                'subject_id': {
                    validators: {
                        notEmpty:{
                            message: 'مضمون کا انتخاب لازمی ھے'
                        }
                    }
                }
                // 
            }

        });// end bootsrapvalidator function for add_teb_subject_result

        $('#add_student_single_subject_marks').bootstrapValidator({

            feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
            },
            fields: {

                'obtained_marks[]': {
                    validators: {
                        regexp: {
                            regexp: /^[0-9]+$/,
                            message: 'غلط نمبر'
                        },
                        between: {
                            min: 0,
                            max: 100,
                            message: 'نمبر صرف 0 سے ۱۰۰ کے درمین ہو سکتے ھیں'
                        }
                    }
                }
                // 
            }

        });// end bootsrapvalidator function for add_student_single_subject_marks

        $('#add_ten_subject_result').bootstrapValidator({

            feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
            },
            fields: {

                'obtained_marks[]': {
                    validators: {
                        regexp: {
                            regexp: /^[0-9]+$/,
                            message: 'غلط نمبر'
                        },
                        between: {
                            min: 0,
                            max: 100,
                            message: 'نمبر صرف 0 سے ۱۰۰ کے درمین ہو سکتے ھیں'
                        }
                    }
                }
                // 
            }

        });// end bootsrapvalidator function for add_teb_subject_result

        $('#print_result_card').bootstrapValidator({

            feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
            },
            fields: {

                'result_date': {
                    validators: {
                        notEmpty:{
                            message: 'رزلٹ ڈیٹ لازمی ھے'
                        },
                        // regexp: {
                        //     regexp: /^[0-3]?[0-9].[0-3]?[0-9].(?:[0-9]{2})?[0-9]{2}$/,
                        //     message: 'غلط نمبر'
                        // },
                        /*between: {
                            min: 2010,
                            max: 2120,
                            message: 'تاریخ کم از کم 2015'
                        }*/
                    }
                },
                'hijri_year': {
                    validators: {
                        notEmpty:{
                            message: 'رزلٹ ھجری سال لازمی ھے'
                        },
                        regexp: {
                            regexp: /^[0-9]+$/,
                            message: 'غلط نمبر'
                        },
                        between: {
                            min: 1400,
                            max: 1530,
                            message: 'تاریخ کم از کم 1400'
                        }
                    }
                },
                'date_of_exam': {
                    validators: {
                        notEmpty:{
                            message: 'تاریخ الامتحان لازمی ھے'
                        }
                    }
                },
                'exam_id': {
                    validators: {
                        notEmpty:{
                            message: 'امتحان کا انتخاب لازمی ھے'
                        }
                    }
                },
                'student_reg' : {
                    validators: {
                        regexp: {
                            regexp: /^[0-9]+$/,
                            message: 'غلط نمبر'
                        }
                    }
                },
                'student_roll_no': {
                    validators: {
                        regexp: {
                            regexp: /^[0-9]+$/,
                            message: 'غلط نمبر'
                        }
                    }
                }
            }

        });// end bootsrapvalidator function for add_teb_subject_result

        $('#degree_form').bootstrapValidator({

            feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                'degree_date_dominic': {
                    validators: {
                        notEmpty:{
                            message: 'ھجری تاریخ لازمی ھے'
                        }
                    }
                },
                'degree_date_english': {
                    validators: {
                        notEmpty:{
                            message: 'انگریزی تاریخ لازمی ھے'
                        }
                    }
                },
                'exam_id': {
                    validators: {
                        notEmpty:{
                            message: 'امتحان کا انتخاب لازمی ھے'
                        }
                    }
                }
            }

        });// end bootsrapvalidator function for add_teb_subject_result

        $('#manage_old_student').bootstrapValidator({

            feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
            },
            fields: {

                'exam_id': {
                    validators: {
                        notEmpty:{
                            message: 'امتحان کا انتخاب کرنا لازمی ھے'
                        },
                        regexp: {
                            regexp: /^[0-9]+$/,
                            message: 'غلط نمبر'
                        }
                    }
                },
                'student_registration_num': {
                    validators: {
                        notEmpty: {
                            message: 'طالب علم کا رجسٹریشن نمبر لازمی ھے'
                        },
                        regexp: {
                            regexp: /^[0-9]+$/,
                            message: 'غلط رجسٹریشن نمبر'
                        },
                        remote: {
                                message: 'رجسٹریشن نمبر پہلے موجود ھے',
                                url: base_url + 'admin/checkStudentRegisterationNoExistsAjax',
                                type: 'POST'
                        }
                    }
                },
                'course_grade': {
                    validators: {
                        notEmpty:{
                            message: 'کورس کا انتخاب لازمی ھے'
                        }
                    }
                },
                'student_from_category': {
                    validators: {
                        notEmpty:{
                            message: 'طالب علم کی شرکت لازمی ھے'
                        }
                    }
                }
            }

        });// end bootsrapvalidator function for add_teb_subject_result

        $('#create_exam_date_sheet_form').bootstrapValidator({

            feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
            },
            fields: {

                'subject_exam_date[]': {
                    validators: {
                        notEmpty: {
                            message: 'تاریخ کا انتخاب لازمی ھے'
                        }
                    }
                },
                'subject_exam_time[]': {
                    validators: {
                        notEmpty: {
                            message: 'وقت لازمی ھے'
                        },
                        regexp: {
                                regexp: /^(1?[0-9]|2[0-3]):[0-5][0-9]$/,
                                message: 'وقت کا اندراج غلط ہے'
                        }
                    }
                },
                'exam_appearence_time[]': {
                    validators: {
                        notEmpty: {
                            message: 'پہر کا انتخاب لازمی ہے'
                        }
                    }
                }
                // 
            }

        });// end bootsrapvalidator function for create_exam_date_sheet_form

        $('#edit_exam_date_sheet_form').bootstrapValidator({

            feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
            },
            fields: {

                'subject_exam_date[]': {
                    validators: {
                        notEmpty: {
                            message: 'تاریخ کا انتخاب لازمی ھے'
                        }
                    }
                },
                'subject_exam_time[]': {
                    validators: {
                        notEmpty: {
                            message: 'وقت لازمی ھے'
                        },
                        regexp: {
                                regexp: /^(1?[0-9]|2[0-3]):[0-5][0-9]$/,
                                message: 'وقت کا اندراج غلط ہے'
                        }
                    }
                },
                'exam_appearence_time[]': {
                    validators: {
                        notEmpty: {
                            message: 'پہر کا انتخاب لازمی ہے'
                        }
                    }
                }
                // 
            }

        });// end bootsrapvalidator function for edit_exam_date_sheet_form
        
        $("#exam_id").change(function(event){
            
            objVal = $(this).val();// 2

            if( (objVal == "" || objVal == "undefined") && (company_id == "" || company_id == "undefined") )return false;

            // disabling the prefix a , prefix b and how many fields and getting parents

            parentElemSubject_id = $("#subject_id").parent();
            parentElemSubject_id.prepend('<i class="fa fa-refresh fa-spin">');

            $.ajax({
                    
                    url: base_url + "admin/get_exam_subjects_ajax/",
                    data: {exam_id: objVal,},
                    type: "POST",
                    dataType : "html",
                    success: function( response ) {
                        //alert(response);  // return false;
                        var obj = jQuery.parseJSON(response);
                        var no_of_subjects = obj.subject_array.length;
                        // console.log(obj.subject_array[0]['sub_id']);
                        $("#subject_id").empty();
                        $("<option></option>", {value:'' , text: '-- مضمون --', selected:'selected' }).appendTo('#subject_id');
                        for (var i = 0; i < no_of_subjects; i++) {
                            $("<option></option>", {value:obj.subject_array[i]['sub_id'] , text: obj.subject_array[i]['sub_name_urdu'] }).appendTo('#subject_id');
                        };
                       
                        parentElemSubject_id.find(".fa-refresh").remove();

                       
                    },
                    error: function( xhr, status, errorThrown ) {
                        alert( "Sorry, there was a problem!" );
                        console.log( "Error: " + errorThrown );
                        console.log( "Status: " + status );
                    },
                    complete: function( xhr, status ) {
                        //alert( "The request is complete!" );
                    }
            });             
        
        });// end blur function at company

        // $( ".target" ).change(function() {
        //   alert( "Handler for .change() called." );
        // });
        $("#date_of_affiliation").change(function(e){
            //This Array For Getting Months With Integer
            var monthNames = {'01':'جنوری','02':'فروری','03':'مارچ','04':'اپریل',
                              '05':'مئی','06':'جون','07':'جولائی','08':'اگست',
                              '09':'ستمبر','10':'اکتوبر','11':'نومبر','12':'دسمبر'
                              };
            selectedDate =  $(this).val();
            selDate = selectedDate.split("-");
            // alert(selDate);
            if ($(this).val() != "" && $(this).val() != null && $(this).val() != "undefined") {
                // alert($(this).val());
                $("#institute_affiliation_from").val(monthNames[selDate[1]] + " " + selDate[0]);
                $("#institute_affiliation_to").val(monthNames[selDate[1]] + " " + ( Number(selDate[0]) + Number(1) ) );

            }
           
        });

        if($("#result_date").length > 0){
            $("#result_date").mask("99-99-9999");
        }// end length method
		
});// end document .ready function

function enableClassGradeType()
{
    fieldAttr = $("#class_grade_type").attr('disabled');

    if (typeof( fieldAttr ) != 'undefined' ) {

        $("#class_grade_type").attr( "disabled", false); 

    }else{

        $("#class_grade_type").attr( "disabled" , true); 

    }
    return true;

}// end funcion enableClassGradeType


/*function padString(str,pad_length,pad_string, pad_type)
{
	
	var output =  str.toString();
    if (pad_type == 'STR_PAD_LEFT') {
		while (output.length < pad_length) {
			output = pad_string + output;
		}
	}else if (pad_type == 'STR_PAD_RIGHT') {
		while (output.length < pad_length) {
			output = output + pad_string;
		}
	}else if (pad_type == 'STR_PAD_BOTH') {
		var j = 0;
		while (output.length < pad_length) {
			if (j % 2) {
				output = output + pad_string;
			} else {
				output = pad_string + output;
			}
			j++;
		}
	}
	return output;
	
}// end function padString*/