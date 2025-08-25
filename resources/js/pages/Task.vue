<script setup lang="ts">
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { Award, Plus, Bookmark } from 'lucide-vue-next';
import AvatarGroup from '@/components/AvatarGroup.vue';
import ActionOption from '@/components/ActionOption.vue';
import { ScrollArea, ScrollBar } from '@/components/ui/scroll-area';
import TaskCard from '@/components/ui/card/TaskCard.vue';
import { Badge } from '@/components/ui/badge';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Tâches',
        href: '/tasks',
    },
];

</script>

<template>

    <Head title="Tâches" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <div class="grid auto-rows-min">

                <div class="p-1 space-y-2 border border-slate-200 text-xs rounded shadow bg-amber-100 text-black/90">
                    <p class="flex items-center uppercase font-bold">
                        <Award :size="18" />
                        Important
                    </p>
                    <p class="ml-1 text-[#000000e3]">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas nemo, impedit debitis quaerat ipsa
                        architecto repellendus aliquam quibusdam laudantium iste laborum odio ut. Alias expedita minus
                        nulla veniam voluptate sed, magni dolorum consequatur magnam explicabo, delectus cupiditate
                        dicta illo iure quaerat qui ratione debitis blanditiis asperiores optio quod quas nemo.
                    </p>
                </div>

            </div>
            <div class="flex-1">
                <div class="flex justify-between items-center">
                    <p class="text-gray-400 text-xs">Projets en cours</p>
                    <Button variant="ghost">
                        <Plus />
                        Nouveau Projet
                    </Button>
                </div>
                <div class="rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">


                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Titre
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tag
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Cessionnaires
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Statut
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Priorité
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Date
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        Site SAPH
                                    </th>
                                    <td class="px-6 py-4">
                                        <Badge>
                                            Vidéosurveillance
                                        </Badge>
                                    </td>
                                    <td class="px-6 py-4">
                                        <AvatarGroup />
                                    </td>
                                    <td class="px-6 py-4">
                                        <Badge class="bg-green-50 text-black" variant="secondary">
                                            <span class="size-[5px] rounded-full bg-green-500"></span> En cours
                                        </Badge>
                                    </td>
                                    <td class="px-6 py-4">
                                        Moyenne
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <ActionOption/>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="flex-1">
                <div class="flex justify-between items-center">
                    <p class="text-gray-400 text-xs">Aperçu des tâches</p>
                    <Button variant="ghost">
                        <Plus />
                        Nouvelle tâche
                    </Button>
                </div>
                <div
                    class="grid grid-cols-3 gap-2 overflow-x-scroll rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">

                    <ScrollArea class="grid bg-zinc-100 rounded-sm gap-2 overflow-x-scroll max-h-[340px] p-2">
                        <div class="flex justify-between items-center px-0.5 my-2">
                            <p class="bg-gray-300 rounded p-1">
                                A Faire
                            </p>
                                <Button variant="ghost">
                                    10 <Bookmark />
                                </Button>
                        </div>
                        <TaskCard priority="Normal" tag="Programming" title="Laravel Framework"
                            description="About The Best PHP Framework Ever."
                            image="https://webandcrafts.com/_next/image?url=https%3A%2F%2Fadmin.wac.co%2Fuploads%2F10_Great_Sites_Built_with_Laravel_Framework_0e893c2354.jpg&w=4500&q=90"
                            :progression="40"
                            />
                        <TaskCard priority="Normal" tag="Programming" title="Laravel Framework"
                            description="About The Best PHP Framework Ever."
                            image="https://webandcrafts.com/_next/image?url=https%3A%2F%2Fadmin.wac.co%2Fuploads%2F10_Great_Sites_Built_with_Laravel_Framework_0e893c2354.jpg&w=4500&q=90"
                            :progression="40"
                            />
                        <TaskCard priority="Normal" tag="Programming" title="Laravel Framework"
                            description="About The Best PHP Framework Ever."
                            image="https://webandcrafts.com/_next/image?url=https%3A%2F%2Fadmin.wac.co%2Fuploads%2F10_Great_Sites_Built_with_Laravel_Framework_0e893c2354.jpg&w=4500&q=90"
                            :progression="40"
                        />
                        
                    </ScrollArea>

                    <ScrollArea class="grid bg-blue-50 rounded-sm gap-2 overflow-x-scroll max-h-[340px] p-2">
                        <div class="flex justify-between items-center px-0.5 my-2">
                            <p class="bg-blue-300 rounded p-1">
                                En cours
                            </p>
                            <div class="flex">
                                <Button variant="link">
                                    <Plus />
                                </Button>
                                <ActionOption />
                            </div>
                        </div>
                        <TaskCard priority="Hight" tag="Learning" title="Learning LLMs"
                            description="How building LLMs from Scratch"
                            image="https://simseo.fr/wp-content/uploads/2024/05/1715818927_Lavancee-des-LLM-les-performances-et-les-defauts-qui.jpeg"
                            :progression="50"
                        />
                        <TaskCard priority="Hight" tag="Learning" title="Learning LLMs"
                            description="How building LLMs from Scratch"
                            image="https://simseo.fr/wp-content/uploads/2024/05/1715818927_Lavancee-des-LLM-les-performances-et-les-defauts-qui.jpeg"
                            :progression="50"
                        />
                        <TaskCard priority="Hight" tag="Learning" title="Learning LLMs"
                            description="How building LLMs from Scratch"
                            image="https://simseo.fr/wp-content/uploads/2024/05/1715818927_Lavancee-des-LLM-les-performances-et-les-defauts-qui.jpeg"
                            :progression="50"
                        />
                    </ScrollArea>

                    <ScrollArea class="grid bg-green-50 rounded-sm gap-2 overflow-x-scroll max-h-[340px] p-2">
                        <div class="flex justify-between items-center px-0.5 my-2">
                            <p class="bg-green-300 rounded p-1">
                                Terminées
                            </p>
                            <div class="flex">
                                <Button variant="link">
                                    <Plus />
                                </Button>
                                <ActionOption />
                            </div>
                        </div>
                        <TaskCard priority="Low" tag="Mission" title="Vidéosurveillance"
                            description="Comment installer une caméra"
                            image="https://ticou.net/site/assets/images/videosurveillance.jpg"
                            :progression="50"
                        />
                    </ScrollArea>


                </div>
            </div>

        </div>
    </AppLayout>
</template>
