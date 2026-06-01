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
const sort = ref('latest')

const getData = async () => {
    try {
        loading.value = true
        const res = await axios.post('http://localhost:8000/api/prompt',
            {
                sort: sort.value
            }
        )
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

const isLike = ref(false)
const like = () => {
    isLike.value = !isLike.value
}

const latest = ref('')

onMounted ( () => {
    getData()
})

</script>

<template>
    <Nav />
    <div class="w-full pt-18 h-screen">
        <div class="flex px-10 flex-col w-full gap-5 justify-center items-center py-10 bg-white text-black">
            <h2 class="text-[32px] font-bold =">All Prompt</h2>
            <input type="search" v-model="search" placeholder="Search Prompt, Author and Category" class="flex-1 w-200 focus:ring-blue-500 max-w-full ring-1 px-3 transition duration-200 rounded-xl ring-gray-400 bg-gray-50 focus:bg-white py-3 focus:outline-0" name="" id="">
            <div class="flex gap-3 w-full md:w-200 items-center">
                <form @submit.prevent="getData" action="" class="flex  items-center gap-3">
                    <select name="" v-model="sort" class="px-3 focus:outline-0 focus:ring focus:ring-blue-500 py-2 shadow rounded-xl" id="">
                        <option value="latest" selected>Latest</option>
                        <option value="oldest">Oldest</option>
                    </select>
                    <button type="submit" class="px-4 py-2 text-white cursor-pointer bg-blue-500 rounded-xl flex items-center gap-2"><i class='bx bx-sort'></i> Sort</button>
                </form>
            </div>
        </div>
        <hr class="mb-5 text-gray-300">
        <div v-if="loading" class="fixed inset-0 z-30 bg-white flex gap-5 items-center justify-center">
            <div class="loader"></div>
            <h1 class="font-bold text-[50px] animate-pulse"><span class="text-blue-500">D</span>way</h1>
        </div>
        <div class="md:grid-cols-4 pb-10 grid-cols-1 grid gap-5 justify-items-center px-5 md:px-10">
            <div @input="getData" v-for="(item, index) in data.filter(i => i.title.toLowerCase().includes(search.toLowerCase()) || i.category.category.toLowerCase().includes(search.toLowerCase()) || i.author.username.toLowerCase().includes(search.toLowerCase()))" class="flex-col w-full overflow-hidden h-fit pb-5 rounded-2xl shadow hover:shadow-xl transition-all duration-200 flex">
                <div class="relative w-full px-2 py-2 justify-between flex h-fit z-10 bg-transparent">
                    <p class="text-[13px] px-2 py-1 rounded-xl text-white bg-green-500/50 w-fit">{{ item.category.category }}</p>
                    <p class="text-[13px] px-2 py-1 bg-white/80 rounded-xl rounded-x w-fit">@{{ item.author.username }}</p>
                </div>
                <div class="w-full h-50 flex">
                    <img :src="`http://localhost:8000/storage/${item.thumbnail}`" class="hover:scale-115 -mt-11 w-full transition duration-200" alt="">
                </div>
                <div class=" bg-white relative z-10">
                <p class="p-5 text-[20px]">
                    {{ item.title }}
                </p>
                <div class="p-2 px-5 -mt-3 mb-3 h-22 overflow-y-auto bg-white rounded transition duration-200 ">
                <p class="">
                    {{ item.prompt }}
                </p>
                </div>
                </div>
                <div class="flex px-5 justify-between">
                    <button @click="copyPrompt(item.prompt, index)" class="p-3 text-[13px] font-semibold h-fit ring-1 ring-blue-500 cursor-pointer rounded-xl text-white bg-blue-500 flex gap-2 items-center"><i :class="isCopied === index ? 'bxs-copy-alt' : 'bx-copy-alt'" class='bx'></i>{{ isCopied === index ? 'Copied!' : 'Copy Prompt' }}</button>
                    <button @click="like" class="p-3 ring-1 ring-green-500 cursor-pointer gap-1 rounded-xl h-fit text-[13px] text-white bg-green-500 flex items-center justify-center"><i :class="isLike === index ? 'bxs-like' : 'bx-like'" class='bx text-[17px]'></i></button>
                </div>
            </div>
        </div>
    </div>
</template>


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