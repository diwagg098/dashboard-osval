    @extends('layout.app')

    <link rel="stylesheet" href="{{ asset('css/form.css')}}">
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>

    @section('title', 'Admin | Product')

    @section('container')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Admin | Product</h3>
                </div>
            </div>

            <div class="clearfix"></div>
    <div class="row">
            @if (session('success'))
            <div class="col-10">
            <div class="alert alert-success alert-dismissable">
                {{ session('success')}}
            </div>
            </div>
                
            @endif
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <div class="clearfix"></div>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog modal-lg">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ url('/product/store')}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field()}}
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="">Product Name<span>*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <input type="text" class="form-control @error('product_name') is-invalid @enderror"
                                            name="product_name" onkeyup="createSlug()">
                                            @error('product_name') <div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="">Price<span>*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <input type="text" class="form-control @error('price') is-invalid @enderror"
                                            name="price" onkeyup="createSlug()">
                                            @error('price') <div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="">Status<span>*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <input type="text" class="form-control @error('status') is-invalid @enderror"
                                            name="status" onkeyup="createSlug()">
                                            @error('status') <div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="">Isi Blog<span>*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <textarea class="ckeditor" id="ckedtor" name="description"></textarea>
                                </div>
                            </div>
                                <div class="item form-group">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">
            <label style="font-size: 14px;">
                <span style='font-weight:bold'>Images Upload Instruction :</span>
            </label>
            <ul>
                <li>
                    Allowed only files with extension (jpg, png)
                </li>
                <li>
                    Maximum number of allowed files 100 with 2400 KB for each
                </li>
                <li>
                    Upload 5 files
                </li>
            </ul>
            <!--To give the control a modern look, I have applied a stylesheet in the parent span.-->
            <span class="btn btn-success fileinput-button">
                <span>Select Images</span>
                <input type="file" name="files[]" id="files" multiple accept="image/jpeg, image/png, image/gif,"><br />
            </span>
            <output id="Filelist"></output>
        </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                        </form>
                            </div>
                            </div>
                        </div>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#fff"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M13 4H6v16h12V9h-5V4zm3 10v2h-3v3h-2v-3H8v-2h3v-3h2v3h3z" opacity=".3"/><path d="M13 11h-2v3H8v2h3v3h2v-3h3v-2h-3zm1-9H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z"/></svg> Add Product
                                    </div>
                                </button>
                            </div>
                            <br>
                            <br>
                    <br>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="shopping-cart">

    <div class="column-labels">
        <label class="product-details">Product</label>
        <label class="product-image">Image</label>
        <label class="product-price">Price</label>
        <label class="product-price">Status</label>
        <label class="product-removal">Remove</label>
    </div>

    @foreach ($content as $row)
    <div class="product">
        <div class="product-image">
            <?php
                $image = json_decode($row->picture);   
            ?>
            <img src="{{ asset('img/' . $image[0])}}" class="img-thumbnail" alt="" style="height:120px; width:180px">
        </div>
        <div class="product-details">
        <div class="product-title">{{ $row->product_name}}</div>
        <p class="product-description">{!! $row->description !!}</p>
        </div>
        <div class="product-price">Rp. {{ number_format($row->price,0,',','.')}}</div>
        <div class="product-price"><span class="badge badge-success">{{ $row->status}}</span></div>
        <div class="product-removal">
        <a class="remove-product" href="{{ url('product/edit/' . $row->id)}}" style="background: green !important">
            Edit
        </a>
        <br>
        <form action="{{ url('product/delete/' . $row->id)}}" method="POST" class="mt-2">
            @csrf
            @method("delete")
            <button type="submit" onclick="return confirm('Anda yakin akan menghapus product ini ?')" class="remove-product">
                Remove
            </button>
        </form>
        </div>
    </div>
        @endforeach

    </div>
                        </div>
                    </div>
                        
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>

    <script>
    //I added event handler for the file upload control to access the files properties.
    document.addEventListener("DOMContentLoaded", init, false);

    //To save an array of attachments
    var AttachmentArray = [];

    //counter for attachment array
    var arrCounter = 0;

    //to make sure the error message for number of files will be shown only one time.
    var filesCounterAlertStatus = false;

    //un ordered list to keep attachments thumbnails
    var ul = document.createElement("ul");
    ul.className = "thumb-Images";
    ul.id = "imgList";

    function init() {
    //add javascript handlers for the file upload event
    document
        .querySelector("#files")
        .addEventListener("change", handleFileSelect, false);
    }

    //the handler for file upload event
    function handleFileSelect(e) {
    //to make sure the user select file/files
    if (!e.target.files) return;

    //To obtaine a File reference
    var files = e.target.files;

    // Loop through the FileList and then to render image files as thumbnails.
    for (var i = 0, f; (f = files[i]); i++) {
        //instantiate a FileReader object to read its contents into memory
        var fileReader = new FileReader();

        // Closure to capture the file information and apply validation.
        fileReader.onload = (function(readerEvt) {
        return function(e) {
            //Apply the validation rules for attachments upload
            ApplyFileValidationRules(readerEvt);

            //Render attachments thumbnails.
            RenderThumbnail(e, readerEvt);

            //Fill the array of attachment
            FillAttachmentArray(e, readerEvt);
        };
        })(f);

        // Read in the image file as a data URL.
        // readAsDataURL: The result property will contain the file/blob's data encoded as a data URL.
        // More info about Data URI scheme https://en.wikipedia.org/wiki/Data_URI_scheme
        fileReader.readAsDataURL(f);
    }
    document
        .getElementById("files")
        .addEventListener("change", handleFileSelect, false);
    }

    //To remove attachment once user click on x button
    jQuery(function($) {
    $("div").on("click", ".img-wrap .close", function() {
        var id = $(this)
        .closest(".img-wrap")
        .find("img")
        .data("id");

        //to remove the deleted item from array
        var elementPos = AttachmentArray.map(function(x) {
        return x.FileName;
        }).indexOf(id);
        if (elementPos !== -1) {
        AttachmentArray.splice(elementPos, 1);
        }

        //to remove image tag
        $(this)
        .parent()
        .find("img")
        .not()
        .remove();

        //to remove div tag that contain the image
        $(this)
        .parent()
        .find("div")
        .not()
        .remove();

        //to remove div tag that contain caption name
        $(this)
        .parent()
        .parent()
        .find("div")
        .not()
        .remove();

        //to remove li tag
        var lis = document.querySelectorAll("#imgList li");
        for (var i = 0; (li = lis[i]); i++) {
        if (li.innerHTML == "") {
            li.parentNode.removeChild(li);
        }
        }
    });
    });

    //Apply the validation rules for attachments upload
    function ApplyFileValidationRules(readerEvt) {
    //To check file type according to upload conditions
    if (CheckFileType(readerEvt.type) == false) {
        alert(
        "The file (" +
            readerEvt.name +
            ") does not match the upload conditions, You can only upload jpg/png/gif files"
        );
        e.preventDefault();
        return;
    }

    //To check file Size according to upload conditions
    if (CheckFileSize(readerEvt.size) == false) {
        alert(
        "The file (" +
            readerEvt.name +
            ") does not match the upload conditions, The maximum file size for uploads should not exceed 3 MB"
        );
        e.preventDefault();
        return;
    }

    //To check files count according to upload conditions
    if (CheckFilesCount(AttachmentArray) == false) {
        if (!filesCounterAlertStatus) {
        filesCounterAlertStatus = true;
        alert(
            "You have added more than 10 files. According to upload conditions you can upload 10 files maximum"
        );
        }
        e.preventDefault();
        return;
    }
    }

    //To check file type according to upload conditions
    function CheckFileType(fileType) {
    if (fileType == "image/jpeg") {
        return true;
    } else if (fileType == "image/png") {
        return true;
    } else if (fileType == "image/gif") {
        return true;
    } else {
        return false;
    }
    return true;
    }

    //To check file Size according to upload conditions
    function CheckFileSize(fileSize) {
    if (fileSize < 3000000) {
        return true;
    } else {
        return false;
    }
    return true;
    }

    //To check files count according to upload conditions
    function CheckFilesCount(AttachmentArray) {
    //Since AttachmentArray.length return the next available index in the array,
    //I have used the loop to get the real length
    var len = 0;
    for (var i = 0; i < AttachmentArray.length; i++) {
        if (AttachmentArray[i] !== undefined) {
        len++;
        }
    }
    //To check the length does not exceed 10 files maximum
    if (len > 9) {
        return false;
    } else {
        return true;
    }
    }

    //Render attachments thumbnails.
    function RenderThumbnail(e, readerEvt) {
    var li = document.createElement("li");
    ul.appendChild(li);
    li.innerHTML = [
        '<div class="img-wrap"> <span class="close">&times;</span>' +
        '<img class="thumb" src="',
        e.target.result,
        '" title="',
        escape(readerEvt.name),
        '" data-id="',
        readerEvt.name,
        '"/>' + "</div>"
    ].join("");

    var div = document.createElement("div");
    div.className = "FileNameCaptionStyle";
    li.appendChild(div);
    div.innerHTML = [readerEvt.name].join("");
    document.getElementById("Filelist").insertBefore(ul, null);
    }

    //Fill the array of attachment
    function FillAttachmentArray(e, readerEvt) {
    AttachmentArray[arrCounter] = {
        AttachmentType: 1,
        ObjectType: 1,
        FileName: readerEvt.name,
        FileDescription: "Attachment",
        NoteText: "",
        MimeType: readerEvt.type,
        Content: e.target.result.split("base64,")[1],
        FileSizeInBytes: readerEvt.size
    };
    arrCounter = arrCounter + 1;
    }


    </script>

    @endsection