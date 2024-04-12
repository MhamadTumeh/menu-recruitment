<template>
    <div>
        <h2>{{ mode === 'add' ? 'Add Discount' : 'Edit Discount' }}</h2>
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" v-model="name">
        </div>
        <div>
            <label for="percentage">Percentage:</label>
            <input type="number" id="percentage" v-model="percentage">
        </div>
        <div>
            <label for="start_date">Start Date:</label>
            <input type="datetime-local" id="start_date" v-model="startDate">
        </div>
        <div>
            <label for="end_date">End Date:</label>
            <input type="datetime-local" id="end_date" v-model="endDate">
        </div>
        <div>
            <label for="type">Type:</label>
            <select id="type" v-model="type">
                <option value="all_menu">All Menu Discount</option>
                <option value="category">Category/Subcategory Discount</option>
                <option value="item">Item Discount</option>
            </select>
        </div>
        <div>
            <label for="discountable_id">Discountable ID:</label>
            <input type="number" id="discountable_id" v-model="discountableId">
        </div>
        <div>
            <label for="discountable_type">Discountable Type:</label>
            <input type="text" id="discountable_type" v-model="discountableType">
        </div>
        <button @click="saveDiscount">{{ mode === 'add' ? 'Save' : 'Update' }}</button>
        <button @click="cancel">Cancel</button>
    </div>
</template>

<script>
import { ref } from 'vue';
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';

export default {
    props: {
        mode: String,
        discount: Object // Only for edit mode
    },
    setup(props) {
        const router = useRouter();
        const store = useStore();
        const name = ref('');
        const percentage = ref(0);
        const startDate = ref('');
        const endDate = ref('');
        const type = ref('');
        const discountableId = ref(0);
        const discountableType = ref('');

        const saveDiscount = async () => {
            const discountData = {
                name: name.value,
                percentage: percentage.value,
                start_date: startDate.value,
                end_date: endDate.value,
                type: type.value,
                discountable_id: discountableId.value,
                discountable_type: discountableType.value
            };
            if (props.mode === 'add') {
                await store.dispatch('adddiscount', discountData);
            } else {
                await store.dispatch('editdiscount', { id: props.discount.id, data: discountData });
            }
            cancel();
        };

        const cancel = () => {
            router.push('/categories');
        };

        const loadDiscount = () => {
            if (props.mode === 'edit' && props.discount) {
                name.value = props.discount.name;
                percentage.value = props.discount.percentage;
                startDate.value = props.discount.start_date;
                endDate.value = props.discount.end_date;
                type.value = props.discount.type;
                discountable_id.value = props.discount.discountable_id;
                discountable_type.value = props.discount.discountable_type;
            }
        };

        loadDiscount();

        return {
            name,
            percentage,
            startDate,
            endDate,
            type,
            discountableId,
            discountableType,
            saveDiscount,
            cancel
        };
    }
};
</script>

<style scoped>
/* Add your component styles here */
</style>