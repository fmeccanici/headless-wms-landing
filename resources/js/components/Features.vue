<template>
    <div class="flex flex-col items-center pr-10">
        <dl
            class="space-y-10 lg:space-y-0 lg:grid lg:grid-cols-4 lg:gap-8 mt-20"
            id="features">
            <feature v-if="(this.isMediumWindowSize() && currentPage === 0) || (! this.isMediumWindowSize())" :title="'Inventory Management'" :text="'Maintain an accurate view of your stock, so you can respond faster to customer demands and improve their satisfaction.'" :svg_path_shape="'M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z'"></feature>
            <feature v-if="(this.isMediumWindowSize() && currentPage === 1) || (! this.isMediumWindowSize())" :title="'Order Picking'" :text="'Generate picklists and backorders for orders and ensure that an order is always completely picked when shipped.'" :svg_path_shape="'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'"></feature>
            <feature v-if="(this.isMediumWindowSize() && currentPage === 2) || (! this.isMediumWindowSize())" :title="'Shipments'" :text="'After a picklist is completed, automatically generate a packing slip and shipment label depending on your set shipping provider.'" :svg_path_shape="'M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z'"></feature>
            <feature v-if="(this.isMediumWindowSize() && currentPage === 3) || (! this.isMediumWindowSize())" :title="'Barcode Scanning'" :text="'Scan inventory items using bar or QR codes that are connected to your products.'" :svg_path_shape="'M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0'"></feature>
            <feature v-if="(this.isMediumWindowSize() && currentPage === 4) || (! this.isMediumWindowSize())" :title="'Incoming Products'" :text="'Incoming products are scanned and marked as returned or new products, we show you where the products should be placed in your warehouse.'" :svg_path_shape="'M19 14l-7 7m0 0l-7-7m7 7V3'"></feature>
            <feature v-if="(this.isMediumWindowSize() && currentPage === 5) || (! this.isMediumWindowSize())" :title="'Products Management'" :text="'Have an overview of all your products, with stock, supplier, sales and purchase price and many more. Products can easily be imported via an Excel sheet.'" :svg_path_shape="'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'"></feature>
            <feature v-if="(this.isMediumWindowSize() && currentPage === 6) || (! this.isMediumWindowSize())" :title="'Users And Roles'" :text="'Add multiple users to your account with different roles and permissions.'" :svg_path_shape="'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'"></feature>
            <feature v-if="(this.isMediumWindowSize() && currentPage === 7) || (! this.isMediumWindowSize())" :title="'Composed Products'" :text="'Add products that are assembled from parts that are kept on stock.'" :svg_path_shape="'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'"></feature>
            <feature v-if="(this.isMediumWindowSize() && currentPage === 8) || (! this.isMediumWindowSize())" :title="'Delivery Date Estimations'" :text="'Based on the lead time of producing a product and the supplier and carrier, the delivery date of an order is estimated.'" :svg_path_shape="'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01'"></feature>
            <feature v-if="(this.isMediumWindowSize() && currentPage === 8) || (! this.isMediumWindowSize())" :title="'Customizable User Experience'" :text="'With a headless approach the frontend is decoupled from the backend, allowing you to customize the user experience.'" :svg_path_shape="'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'"></feature>
            <feature v-if="(this.isMediumWindowSize() && currentPage === 8) || (! this.isMediumWindowSize())" :title="'Developer friendly'" :text="'A well documented and extensive API that developers like to work with.'" :svg_path_shape="'M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'"></feature>
            <feature v-if="(this.isMediumWindowSize() && currentPage === 8) || (! this.isMediumWindowSize())" :title="'Frequent updates'" :text="'Because we solely focus on developing an API, we frequently add new functionalities.'" :svg_path_shape="'M13 10V3L4 14h7v7l9-11h-7z'"></feature>
            <feature v-if="(this.isMediumWindowSize() && currentPage === 8) || (! this.isMediumWindowSize())" :title="'Easy and fast integration'" :text="'We are API driven, which means we encourage and provide seamless integration with your existing software.'" :svg_path_shape="'M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z'"></feature>
        </dl>

        <div
            v-if="this.isMediumWindowSize()"
            class="space-x-5 mt-10">
            <i @click="this.currentPage = index" v-for="(dot, index) in 9" class="fa-solid fa-circle scale-150 cursor-pointer" :class="{ 'text-orange-400' : index === this.currentPage }">

            </i>
        </div>
    </div>
</template>

<script>
export default {
    name: "Features",
    props: ['title', 'text', 'svg_path_shape'],
    data() {
        return {
            'currentPage' : 0,
            'windowWidth' : 0,
            'touchStartX' : 0,
            'touchStartY' : 0,
            'touchEndX' : 0,
            'touchEndY' : 0,
            'maxPage' : 9,
            'minPage' : 0
        }
    },
    created() {
        window.addEventListener('resize', this.handleResize);
        this.handleResize();
        this.addSwipeEventListeners();
    },
    methods: {
        addSwipeEventListeners() {
            window.addEventListener('touchstart', this.handleTouchStart);
            window.addEventListener('touchend', this.handleTouchEnd);
        },
        isMediumWindowSize() {
            return this.windowWidth <= 768;
        },
        handleResize() {
            this.windowWidth = window.innerWidth;
            this.windowHeight = window.innerHeight;
        },
        handleTouchStart() {
            this.touchStartX = event.changedTouches[0].screenX;
            this.touchStartY = event.changedTouches[0].screenY;
        },
        handleTouchEnd() {
            this.touchEndX = event.changedTouches[0].screenX;
            this.touchEndY = event.changedTouches[0].screenY;

            if (this.touchEndX < this.touchStartX) {
                // 'Swiped Left'
                if (this.currentPage <= this.maxPage - 1)
                {
                    this.currentPage ++;
                }
            }

            if (this.touchEndX > this.touchStartX) {
                // 'Swiped Right'
                if (this.currentPage >= this.minPage + 1)
                {
                    this.currentPage --;
                }
            }

            if (this.touchEndY < this.touchStartY) {
                // 'Swiped Up'
            }

            if (this.touchEndY > this.touchStartY) {
                // 'Swiped Down'
            }

            if (this.touchEndY === this.touchStartY) {
                // 'Tap'
            }
        }
    }
}
</script>

<style scoped>

</style>
