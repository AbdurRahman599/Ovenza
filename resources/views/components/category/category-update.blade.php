<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Updatee Category</h6>
            </div>
            <div class="modal-body">
                <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Category Name *</label>
                                <input type="text" class="form-control" id="categoryNameUpdate">
                                <input class = "d-none" id="updateID" style="width: 300px; height: 40px; padding: 32px; border: 2px solid #ccc; border-radius: 5px; font-size: 16px; background-color: #f9f9f9; color: #333; box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2); outline: none;" />

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="Update()" id="update-btn" class="btn bg-gradient-success" >Update</button>
            </div>
        </div>
    </div>
</div>


<script>

    async function FillUpUpdateForm(id){
        document.getElementById('updateID').value=id;
        showLoader();
        let res= await axios.post("/category-by-id",{id:id});
        hideLoader();
        document.getElementById('categoryNameUpdate').value=res.data['name'];
    }



    async function Update() {
        let categoryName = document.getElementById('categoryNameUpdate').value;
        let updateID = document.getElementById('updateID').value;
        if(categoryName.length === 0){
            errorToast("Category Required !")
        }
        else {
            document.getElementById('update-modal-close').click();
            showLoader();
            let res = await axios.post("/update-category",{name:categoryName,id:updateID})
            hideLoader();

            if(res.status === 200 && res.data===1){
                successToast("Category updated successfully")
                document.getElementById("save-form").reset();
                await getList();
            }
            else{
                errorToast("Request Failed.")
            }

    }   }
</script>
