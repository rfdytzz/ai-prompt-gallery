<script setup>
import Admin from '@/components/Admin.vue';
</script>

<template>
    <Admin />
    <div class="ml-64 h-20 items-center px-5 flex justify-between">
        <router-link to="/dashboard/allusers" class="relative hover:text-blue-500">All User</router-link>
    </div>

    <div class="items-center pb-5 grid grid-cols-4 w-full gap-5 pl-69 pt-2 pr-5">
        <div class="shadow flex w-full flex-col justify-between items-start gap-4 p-5 col-span-4 rounded hover:shadow transition duration-100 border border-gray-200">
            <h1 class="font-normal text-sm">Search All User <span class="font-semibold">{{ name }}</span></h1>
            <input type="search" placeholder="Search for users by name and username" class="focus:outline-0 p-3 w-full ring ring-gray-300 bg-gray-50 focus:bg-white transition focus:shadow duration-100 focus:ring-blue-500 rounded-xl">
        </div>
    </div>
    <div class="w-full h-fit pl-69 pr-5">
        <div class="flex mb-5 gap-2">
            <button class="py-2 px-3 bg-blue-500 text-white rounded-xl cursor-pointer">Latest</button>
            <button class="py-2 px-3 hover:bg-blue-100 transition duration-200 bg-gray-100 rounded-xl cursor-pointer">Oldest</button>
        </div>
        <div class="w-full shadow h-fit">
            <table class="w-full">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="p-3 text-start">No</th>
                        <th class="p-3 text-start">ID</th>
                        <th class="p-3 text-start">Name</th>
                        <th class="p-3 text-start">Username</th>
                        <th class="p-3 text-start">Email</th>
                        <th class="p-3 text-start">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-100">
                    <tr class="hover:bg-blue-50 border-b border-blue-200 transition duration-50">
                        <td class="p-3 text-start">1</td>
                        <td class="p-3 text-start">0001</td>
                        <td class="p-3 text-start">Rafka Dyta</td>
                        <td class="p-3 text-start">@dpraf51</td>
                        <td class="p-3 text-start">rafka@mail.com</td>
                        <td class="p-3 text-start flex gap-2">
                            <!-- <button class="p-2 bg-yellow-500 items-center flex rounded text-white hover:bg-yellow-600 transition duration-100 cursor-pointer"><i class='bx bxs-edit' ></i></button> -->
                            <button class="p-2 bg-green-500 items-center flex rounded text-white hover:bg-green-600 transition duration-100 cursor-pointer"><i class='bx bx-show' ></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>