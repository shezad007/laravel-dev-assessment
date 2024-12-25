<script setup lang="ts">
import { ref, onMounted } from 'vue';
import Hero from '@/Components/Dashboard/Hero.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import moment from 'moment';

const cards = ref<any[]>([]);
const isLoading = ref(true);
const error = ref<string | null>(null);
const currentPage = ref(1);
const lastPage = ref(1);

const fetchCardData = async (page = 1) => {
    try {
        const response = await axios.get(`/dashboard-jobs?page=${page}`);
        const responseData = response.data.data;

        cards.value = responseData.data;

        cards.value = responseData.data.map((card: any) => ({
            ...card,
            formattedCreatedAt: moment(card.created_at).fromNow(),
        }));

        currentPage.value = responseData.current_page;
        lastPage.value = responseData.last_page;
    } catch (err) {
        error.value = 'Failed to fetch card data. Please try again later.';
        console.error(err);
    } finally {
        isLoading.value = false;
    }
};

onMounted(fetchCardData);

</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <!-- Hero -->
        <Hero />

        <!-- Job List -->
        <div class="bg-white">
            <div class="container py-5">
                <!-- TODO: Add job list here -->
                <div v-if="isLoading" class="text-center">Loading...</div>
                
                <!-- Error Message -->
                <div v-else-if="error" class="text-center text-red-500">{{ error }}</div>
                
                <div v-else class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div v-for="card in cards" :key="card.id" class="bg-white shadow-md rounded-lg p-5 border">
                        <div class="flex justify-between items-center mb-4">
                            <div class="flex ml-4">
                                <img :src="card.company_logo" alt="Company Logo" class="w-12 h-12 rounded-full" />
                                <div class="ml-4">
                                    <h3 class="text-lg font-semibold text-gray-800">{{ card.title }}</h3>
                                    <p class="text-sm text-gray-600">{{ card.company_name }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="bg-gray-300 text-black-600 text-xs px-3 py-1 rounded-full" v-for="extra in card.extras">{{ extra.extra }}</span>
                            </div>
                        </div>
                        <div class="flex items-center text-sm text-gray-600 mb-4">
                            <span class="flex items-center mr-4">
                                <svg width="20px" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13.5 9.43333V12.2667C13.5 12.996 12.9753 13.624 12.252 13.72C10.8607 13.9047 9.44134 14 8.00001 14C6.55867 14 5.13934 13.9047 3.74801 13.72C3.02467 13.624 2.50001 12.996 2.50001 12.2667V9.43333M13.5 9.43333C13.6583 9.29577 13.785 9.12557 13.8713 8.93442C13.9576 8.74328 14.0015 8.53572 14 8.326V5.804C14 5.08333 13.488 4.46067 12.7753 4.354C12.0202 4.24095 11.2613 4.15489 10.5 4.096M13.5 9.43333C13.3707 9.54333 13.22 9.63 13.0513 9.68667C11.4222 10.2272 9.71653 10.5019 8.00001 10.5C6.23467 10.5 4.53667 10.214 2.94867 9.68667C2.78418 9.63195 2.63182 9.54592 2.50001 9.43333M2.50001 9.43333C2.3417 9.29577 2.21505 9.12557 2.12874 8.93442C2.04243 8.74328 1.99851 8.53572 2.00001 8.326V5.804C2.00001 5.08333 2.51201 4.46067 3.22467 4.354C3.9798 4.24094 4.73873 4.15489 5.50001 4.096M10.5 4.096V3.5C10.5 3.10218 10.342 2.72064 10.0607 2.43934C9.77936 2.15804 9.39783 2 9.00001 2H7.00001C6.60218 2 6.22065 2.15804 5.93935 2.43934C5.65804 2.72064 5.50001 3.10218 5.50001 3.5V4.096M10.5 4.096C8.83582 3.96739 7.16419 3.96739 5.50001 4.096M8.00001 8.5H8.00534V8.50533H8.00001V8.5Z"
                                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                                </svg> {{ card.experience }} Yrs
                            </span>
                            <span class="flex items-center mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 8.25H9m6 3H9m3 6-3-3h1.5a3 3 0 1 0 0-6M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg> {{ card.salary }} Lacs PA
                            </span>
                            <span class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg> {{ card.location }}
                            </span>
                        </div>
                        <span class="flex items-center">
                            <svg width="30px" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13 10V8.25C13 7.65326 12.7629 7.08097 12.341 6.65901C11.919 6.23705 11.3467 6 10.75 6H9.75C9.55109 6 9.36032 5.92098 9.21967 5.78033C9.07902 5.63968 9 5.44891 9 5.25V4.25C9 3.65326 8.76295 3.08097 8.34099 2.65901C7.91903 2.23705 7.34674 2 6.75 2H5.5M5.5 10.5H10.5M5.5 12.5H8M7 2H3.75C3.336 2 3 2.336 3 2.75V14.25C3 14.664 3.336 15 3.75 15H12.25C12.664 15 13 14.664 13 14.25V8C13 6.4087 12.3679 4.88258 11.2426 3.75736C10.1174 2.63214 8.5913 2 7 2Z"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <p class="text-gray-700 mb-4">
                                {{ card.description }}
                            </p>
                        </span>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="bg-gray-100 text-gray-600 text-xs px-3 py-1 rounded-full" v-for="skill in card.skills">{{ skill.skill }}</span>
                        </div>
                        <div class="flex justify-end items-center">
                            <span class="text-sm text-gray-500">{{ card.formattedCreatedAt }}</span>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
