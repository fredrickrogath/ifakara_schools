<template>
    <!-- <v-col>
        <v-row> -->
    <div>
        <spinner v-if="showLoader"></spinner>

        <v-col v-else sm="12" md="12">
            <!-- <v-card flat :dark="isDark"> -->
            <!-- <v-card elevation="0" data-app> -->

            <!-- Warning Alert Modal -->
            <div
                id="warning-alert-modal"
                class="modal fade"
                tabindex="-1"
                role="dialog"
                aria-hidden="true"
            >
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-body p-2">
                            <div class="text-center">
                                <i
                                    class="dripicons-warning h1 text-warning"
                                ></i>
                                <h4 class="mt-2 text-gray-500">
                                    Are you sure you want to delete this data ?
                                </h4>
                                <p class="mt-3">
                                    Do not worry, deleting this can be restored
                                    in your trash within 30 days.
                                </p>
                                <div class="flex justify-around">
                                    <button
                                        type="button"
                                        class="btn btn-sm btn-warning my-1 text-white"
                                        data-bs-dismiss="modal"
                                        @click="deleteInvoice()"
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

            <v-card-title class="px-0 pt-0 pb-1">
                        <div class="pl-2 pt-1 text-sm uppercase">Invoices</div>
                        <v-spacer></v-spacer>
                        <snackbar message="Task completed successfully"></snackbar>

                        <div class="flex col-3 p-0 pt-1 mr-2">
                            <input v-model="search" type="text" class="form-control form-control-sm" />
                            <v-icon size="20" class="px-1">mdi-magnify</v-icon>
                        </div>
            </v-card-title>
            <hr class="bg-gray-200 mb-1 mt-0" />
            <!-- {{ $page.props.posts }} -->

            <v-data-table
                :headers="headers"
                :items="invoices"
                item-key="name"
                :search="search"
                class="elevation-1"
                :items-per-page="11"
                dense
            >
                <template v-slot:body="{ items, headers }">
                    <tbody>
                        <tr v-for="(item, idx, k) in items" :key="idx">
                            <td v-for="(header, key) in headers" :key="key">
                                <v-icon
                                    v-if="header.value == 'head'"
                                    size="22"
                                    @click="verifyInvoiceCreation(items[idx]['id'], items[idx]['status_from_head'])"
                                >
                                    {{ items[idx]['status_from_head'] ? 'mdi-cancel' : 'mdi-check-circle' }}
                                </v-icon>
                                <v-icon
                                    v-if="header.value == 'finance'"
                                    size="22"
                                >
                                    {{ items[idx]['status_from_financial_accountant'] ? 'mdi-cancel' : 'mdi-check-circle' }}
                                </v-icon>

                                <v-icon
                                    v-if="header.value == 'view'"
                                    size="22"
                                    @click=" setInvoiceView(items[idx]['id'])"
                                >
                                    mdi-eye
                                </v-icon>

                                <v-icon
                                    v-if="header.value == 'starred'"
                                    size="22"
                                    :class="
                                        item[header.value] ? 'text-warning' : ''
                                    "
                                    @click="
                                        starredInvoice(
                                            items[idx]['id'],
                                            item[header.value],
                                            header.value
                                        )
                                    "
                                >
                                    mdi-star
                                </v-icon>

                                <span
                                    class="text-green-500 italic font-semibold"
                                    v-else-if="header.value == 'total'"
                                    >{{ formattedPrice(item[header.value]) }}</span
                                >

                                <span
                                    class="text-gray-600 italic font-semibold"
                                    v-else-if="header.value == 'created_at'"
                                    >{{
                                        formattedDate(item[header.value])
                                    }}</span
                                >

                                <!-- <span
                                    class="text-gray-600 italic font-semibold"
                                    v-else-if="header.value == 'updated_at'"
                                    >{{
                                        formattedDate(item[header.value])
                                    }}</span
                                >

                                <span
                                    class="text-gray-600 italic font-semibold"
                                    v-else-if="header.value == 'sellers'"
                                    >
                                    
                                    <span
                                        v-for="seller in item[header.value]"
                                        :key="seller.id"
                                        class="d-block"
                                    >
                                        <div class="">
                                            <v-menu transition="fab-transition">
                                                <template
                                                    v-slot:activator="{
                                                        on,
                                                        attrs,
                                                    }"
                                                >
                                                    <span
                                                        class="seller-name"
                                                        v-bind="attrs"
                                                        v-on="on"
                                                        @click="getSellerProfile(seller)"
                                                    >
                                                        {{ seller.name }}
                                                    </span>
                                                </template>

                                                <seller-profile :seller="sellerInfo"></seller-profile>
                                            </v-menu>
                                        </div>
                                    </span>
                                    
                                    </span
                                > -->

                                <span
                                    class="text-gray-600 italic font-semibold"
                                    v-else-if="header.value == 'invoice_items'"
                                >
                                    <div v-for="item in item[header.value]">
                                        <span>
                                            Name {{ item.name }}
                                        </span>

                                        <v-icon
                                                    size="20"
                                                    class="mb-1 px-1"
                                                    >mdi-hand-pointing-right</v-icon
                                                >

                                        <span>
                                           Price <span class="text-green-500">{{ formattedPrice(item.price) }}</span>
                                        </span>

                                        <v-icon
                                                    size="20"
                                                    class="mb-1 px-1"
                                                    >mdi-hand-pointing-right</v-icon
                                                >

                                        <span>
                                           Description {{ item.description }}
                                        </span>
                                    </div>
                                </span>

                                <!-- <span
                                    class="text-gray-600 italic font-semibold"
                                    v-else-if="header.value == 'invoice_items'"
                                >
                                    <div v-for="item in item[header.value]">
                                        <span>
                                            {{ item.name }}
                                        </span>
                                    </div>
                                </span> -->

                                <!-- <span
                                    class="text-gray-600 italic font-semibold"
                                    v-else-if="header.value == 'tool_sum'"
                                >
                                    {{ 
                                        formattedPrice(totalPrice(item.invoice_tool))
                                    }}
                                </span> -->
                            </td>
                        </tr>
                    </tbody>
                </template>
            </v-data-table>
        </v-col>
    </div>
    <!-- </v-row>
    </v-col> -->
</template>

<script>
import moment from "moment";
import Spinner from "../../../../Components/SpinnerLoader.vue";
import Snackbar from "../../../../Components/Snackbar";
import SellerProfile from "../../../../Components/SellerProfile.vue";
export default {
    components: {
        Spinner,
        Snackbar,
        SellerProfile,
    },

    props: {
        // postsData: {
        // type: Number,
        // default: [],
        // default(rawProps) {
        //     return { message: "hello" };
        // },
        // DATA TYPES
        // String
        // Number
        // Boolean
        // Array
        // Object
        // Date
        // Function
        // Symbol
        // disabled: [Boolean, Number]
        // },
    },

    mounted() {
        this.showLoader = true;
        this.getInvoices();

        // Receiving broadicasting
        window.Echo.channel("EventTriggered").listen(
            "NewPostPublished",
            (e) => {
                // console.log('abc');
                this.getInvoices();
            }
        );
    },

    data() {
        return {
            contentFullWidthWhenSideBarHides: 10,
            storagePath: window.location.origin + "/storage/systemFiles/",

            showLoader: true,
            search: "",
            headers: [
                // {
                //     text: "Invoice #",
                //     align: "start",
                //     sortable: false,
                //     value: "id",
                // },
                {
                    text: "Total",
                    value: "total",
                },
                {
                    text: "Items",
                    value: "invoice_items",
                },
                // {
                //     text: "Total",
                //     value: "tool_sum",
                // },
                // { text: "Starred", value: "starred" },
                { text: "Date", value: "created_at" },
                { text: "Head", value: "head" },
                { text: "Finance", value: "finance" },
                // { text: "Created At", value: "created_at" },
            ],
            invoices: [],

            idForAction: null,

            sellerInfo: [],
        };
    },

    computed: {
        contentFullWidthWhenSideBarHidesComputed() {
            return this.contentFullWidthWhenSideBarHides;
        },
    },

    methods: {
        async verifyInvoiceCreation(id) {
            this.idForAction = id;
        },

        formattedPrice(amount) {
            return amount.toLocaleString("sw-TZ", {
                style: "currency",
                currency: "Tsh",
            });
        },

        formattedDate(date) {
            return moment(date).format("MMMM Do YYYY");
            // return moment(date).format("MMMM Do YYYY, h:mm:ss a");
        },

        totalPrice(item) {
            return item.reduce((total, item) => {
                return total + item.tool.price * item.count;
            }, 0);
        },

        getSellerProfile(seller) {
            this.sellerInfo = seller
        },

        getInvoices() {
            axios.get("/head/getInvoicesCreation").then((response) => {
                this.invoices = response.data.data;
                this.showLoader = false;
                // console.log(response.data.data)
            });
        },

        // async updateTools(id, column, data) {
        //     axios
        //         .post("/accountant/updateTools", {
        //             id: id,
        //             data: data,
        //             column: column,
        //         })
        //         .then((response) => {
        //             // this.students = response.data.data;
        //             // this.amount = "";
        //             // this.narration = "";
        //             // console.log(response.data.data);
        //         });
        //     // handle response here
        // },

        async verifyInvoiceCreation(id , status_from_head) {
            axios
                .post("/head/verifyInvoiceCreation", {
                    id: id,
                    status_from_head: status_from_head
                })
                .then((response) => {
                    // this.students = response.data.data;
                    // console.log(response.data.data);
                });
            // handle response here
        },

        // async starredInvoice(id,data ,column) {
        //     axios
        //         .post("/accountant/starredInvoice", {
        //             id: id,
        //             data: data,
        //             column: column,
        //         })
        //         .then((response) => {
        //             // this.students = response.data.data;
        //             // this.amount = "";
        //             // this.narration = "";
        //             // console.log(response.data.data);
        //         });
        //     // handle response here
        // },

        setInvoiceView(id) {
            this.$store.dispatch("AccountantInvoiceModule/setInvoiceView", id);
        },

        save(id, column, data) {
            this.updateTools(id, data, column);
            // console.log(id + " , " +data);
        },
        cancel() {},
        open() {},
        close() {},
    },
};
</script>
