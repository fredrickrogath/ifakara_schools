<template>
    <div>
        <!-- Warning Alert Modal -->
        <div
            id="warning-alert-modal1"
            class="modal fade"
            tabindex="-1"
            role="dialog"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body p-2">
                        <div class="text-center">
                            <i class="dripicons-warning h1 text-warning"></i>
                            <h4 class="mt-2 text-gray-500">
                                Are you sure you want to delete this data ?
                            </h4>
                            <p class="mt-3">
                                Do not worry, deleting this can be restored in
                                your trash within 30 days.
                            </p>
                            <div class="flex justify-around">
                                <button
                                    type="button"
                                    class="btn btn-sm btn-warning my-1 text-white"
                                    data-bs-dismiss="modal"
                                    @click="deleteUpload()"
                                >
                                    Continue
                                </button>
                                <button
                                    type="button"
                                    class="btn btn-sm btn-danger my-1 text-white"
                                    data-bs-dismiss="modal"
                                >
                                    cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <div class="">
            <div class="card-body">

                <snack-bar message="Task completed successfully"></snack-bar>
                
                <div class="row">
                    <div class="col-8 text-center">
                        <h4>Table for all documents</h4>
                    </div>

                    <div class="col-4">
                        <form>
                            <div class="mb-2">
                                <label
                                    for="inputPassword2"
                                    class="visually-hidden"
                                    >Search</label
                                >
                                <input
                                    v-model="search"
                                    type="search"
                                    class="form-control"
                                    id="inputPassword2"
                                    placeholder="Search..."
                                />
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <v-data-table
                mobile-breakpoint="0"
                :headers="headers"
                :items="uploads"
                :search="search"
                :items-per-page="11"
                dense
                class=""
            >
                <template v-slot:item.title="{ item }">
                    <span class="text-gray-600 italic font-semibold">{{ item.title }}</span>
                </template>

                <template v-slot:item.name="{ item }">
                    <span class="text-gray-600 italic font-semibold">{{ item.name }}</span>
                </template>

                <template v-slot:item.description="{ item }">
                    <span class="text-gray-600 italic font-semibold">{{ item.description }}</span>
                </template>

                <template v-slot:item.action="{ item }">
                    <span class="text-gray-600 italic font-semibold">
                        <v-icon
                            size="22"
                            type="button"
                            data-bs-toggle="modal"
                            data-bs-target="#warning-alert-modal1"
                            @click="setIdForAction(item.id)"
                        >
                            mdi-delete
                        </v-icon>
                    </span>
                </template>

                <template v-slot:item.view="{ item }">
                    <a class="text-gray-600 italic font-semibold" :href="storagePath + item.path">
                        <v-icon size="22" @click=""> mdi-eye </v-icon>
                    </a>
                </template>

                <template v-slot:item.user.name="{ item }">
                    <span class="text-gray-600 italic font-semibold">{{ item.user.name }}</span>
                </template>

                <template v-slot:item.amount="{ item }">
                    <span class="text-gray-600 italic font-semibold">{{
                        formattedPrice(item.amount)
                    }}</span>
                </template>

                <template v-slot:item.narration="{ item }">
                    <span class="text-gray-600 italic font-semibold">{{ item.narration }}</span>
                </template>

                <template v-slot:item.created_at="{ item }">
                    <span class="text-gray-600 italic font-semibold">{{
                        formattedDate(item.created_at)
                    }}</span>
                </template>
            </v-data-table>
        </div>
    </div>
</template>

<script>
import moment from "moment";
import SnackBar from "../../../Components/SnackBar.vue";
export default {
    components: {
        SnackBar,
    },
    mounted() {
        // this.showLoader = true;
        this.getNewUploads();

        // Receiving broadicasting
        window.Echo.channel("EventTriggered").listen(
            "NewPostPublished",
            (e) => {
                // console.log('abc');
                this.getNewUploads();
            }
        );
    },

    data() {
        return {
            search: "",
            headers: [
                {
                    text: "Title",
                    align: "start",
                    sortable: false,
                    value: "title",
                },
                // {
                //     text: "Name of document",
                //     value: "name",
                // },
                // { text: "Made For", value: "user.name", align: "center" },
                // { text: "Amount", value: "amount" },
                { text: "Description", value: "description" },
                { text: "Date", value: "created_at" },

                { text: "View", value: "view" },
                { text: "Action", value: "action" },
            ],
            // posts: this.$store.getters["getPosts"],
            // posts: null,
            uploads: [],

            storagePath: window.location.origin + "/storage/",
        };
    },

    methods: {
        formattedDate(date) {
            // return moment(date).format("MMMM Do YYYY");
            return moment(date).format("MMMM Do YYYY, h:mm:ss a");
        },

        async setIdForAction(id) {
            this.idForAction = id;
        },

        getNewUploads() {
            axios.get("/academic/getNewUploads").then((response) => {
                this.uploads = response.data.data;
                // this.showLoader = false;
                // console.log(response.data.data);
            });
        },

        async deleteUpload() {
            axios
                .post("/academic/deleteUpload", {
                    id: this.idForAction,
                })
                .then((response) => {
                    // this.students = response.data.data;
                    // console.log(response.data.data);
                });
            // handle response here
        },
    },
};
</script>
