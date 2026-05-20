<script setup>
import Nav from '@/components/Nav.vue';
import axios from 'axios';
import { onMounted, ref } from 'vue';
onMounted(() => {
    document.title = 'Prompt | DwayPrompts'
})

const data = ref([])
const search = ref('')
const loading = ref(false)

const getData = async () => {
    try {
        loading.value = true
        const res = await axios.get('http://localhost:8000/api/prompt',)
        console.log(res.data)
        data.value = res.data
    } catch (error) {
        console.log(error)
    } finally {
        loading.value = false
    }
}

const click = async (text) => {
    await navigator.clipboard.writeText(text)
    return alert('Copied')
}

const isCopied = ref(null)
const copyPrompt = (prompt, index) => {
    navigator.clipboard.writeText(prompt)
    isCopied.value = index
}

onMounted ( () => {
    getData()
})

</script>

<style>
/* HTML: <div class="loader"></div> */
.loader {
  width: 50px;
  aspect-ratio: 1;
  border-radius: 50%;
  border: 8px solid #514b82;
  animation:
    l20-1 0.8s infinite linear alternate,
    l20-2 1.6s infinite linear;
}
@keyframes l20-1{
   0%    {clip-path: polygon(50% 50%,0       0,  50%   0%,  50%    0%, 50%    0%, 50%    0%, 50%    0% )}
   12.5% {clip-path: polygon(50% 50%,0       0,  50%   0%,  100%   0%, 100%   0%, 100%   0%, 100%   0% )}
   25%   {clip-path: polygon(50% 50%,0       0,  50%   0%,  100%   0%, 100% 100%, 100% 100%, 100% 100% )}
   50%   {clip-path: polygon(50% 50%,0       0,  50%   0%,  100%   0%, 100% 100%, 50%  100%, 0%   100% )}
   62.5% {clip-path: polygon(50% 50%,100%    0, 100%   0%,  100%   0%, 100% 100%, 50%  100%, 0%   100% )}
   75%   {clip-path: polygon(50% 50%,100% 100%, 100% 100%,  100% 100%, 100% 100%, 50%  100%, 0%   100% )}
   100%  {clip-path: polygon(50% 50%,50%  100%,  50% 100%,   50% 100%,  50% 100%, 50%  100%, 0%   100% )}
}
@keyframes l20-2{ 
  0%    {transform:scaleY(1)  rotate(0deg)}
  49.99%{transform:scaleY(1)  rotate(135deg)}
  50%   {transform:scaleY(-1) rotate(0deg)}
  100%  {transform:scaleY(-1) rotate(-135deg)}
}
</style>

<template>
    <Nav />
    <div class="w-full pt-18 h-screen">
        <div class="flex px-10 flex-col w-full gap-5 justify-center items-center py-10 bg-white text-black">
            <h2 class="text-[32px] font-bold">All Prompt</h2>
            <input type="search" v-model="search" placeholder="Search Prompt, Author and Category" class="flex-1 w-200 focus:ring-blue-500 max-w-full ring-1 px-3 transition duration-200 rounded-xl ring-gray-400 bg-gray-100 focus:bg-white py-3 focus:outline-0" name="" id="">
            <div class="flex gap-3 w-full md:w-200 items-center">
                <div class="px-3 bg-blue-500 hover:bg-blue-500 hover:text-white text-white rounded-xl cursor-pointer py-2">Latest</div>
                <div class="px-3 bg-gray-100 rounded-xl transition duration-200 hover:bg-blue-500 hover:text-white cursor-pointer py-2">Oldest</div>
                <div class="px-3 bg-gray-100 rounded-xl transition duration-200 hover:bg-blue-500 hover:text-white cursor-pointer py-2">Popular</div>
            </div>
        </div>
        <hr class="mb-5 text-gray-300">
        <div v-if="loading" class="w-full gap-2 flex h-100 items-center justify-center">
        <div class="loader"></div> Loading
        </div>
        <div class="md:grid-cols-4 pb-10 grid-cols-1 grid gap-5 justify-items-center px-5 md:px-10">
            <div @input="getData" v-for="(item, index) in data.filter(i => i.title.toLowerCase().includes(search.toLowerCase()) || i.category.category.toLowerCase().includes(search.toLowerCase()) || i.author.username.toLowerCase().includes(search.toLowerCase()))" class="flex-col w-full overflow-hidden h-fit pb-5 rounded-xl shadow hover:shadow-xl transition-all duration-200 flex">
                <div class="relative w-full px-2 py-2 justify-between flex h-fit z-10 bg-transparent">
                    <p class="text-[13px] px-2 py-1 rounded-xl text-white bg-green-500/50 w-fit">{{ item.category.category }}</p>
                    <p class="text-[13px] px-2 py-1 bg-white/80 rounded-xl rounded-x w-fit">@{{ item.author.username }}</p>
                </div>
                <div class="w-full">
                    <img src="/public/img/sample.jpg" class="hover:scale-115 -mt-11 transition duration-200" alt="">
                </div>
                <div class="p-5 bg-white relative z-10">
                <p class="text-[20px]">
                    {{ item.title }}
                </p>
                <p class="text-[15px]">
                    {{ item.description }}
                </p>
                <div class="p-2 mt-5 h-25 overflow-y-auto bg-white shadow rounded transition duration-200 hover:shadow-xl">
                <p class="">
                    {{ item.prompt }}
                </p>
                </div>
                </div>
                <div class="flex px-5 justify-between">
                    <button @click="copyPrompt(item.prompt, index)" class="p-3 text-[13px] h-fit ring-1 ring-blue-500 cursor-pointer rounded-xl text-blue-700 bg-blue-500/50">{{ isCopied === index ? 'Copied!' : 'Copy Prompt' }}</button>
                    <button class="p-3 ring-1 ring-blue-500 cursor-pointer gap-1 rounded-xl h-fit text-[13px] text-blue-700 bg-blue-500/50 flex items-center justify-center"><i class='bx bx-like text-[17px]'></i> 100K</button>
                </div>
            </div>
        </div>
    </div>
</template>