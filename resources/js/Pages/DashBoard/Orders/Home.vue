<template>
    <div>

        <Head title="Pedidos" />
        <AuthenticatedLayout>
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pedidos</h2>
            </template>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            Lista de Pedidos
                            <!-- <div v-if="$page.props.flash.message" class="alert alert-success">
                                {{ $page . props . flash . message }}
                            </div> -->
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Usuario</th>
                                            <th scope="col">Dia</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in orders" :key="index">
                                            <td>{{ item . user_id }}</td>
                                            <td>{{ item . created_at }}</td>
                                            <td>100.00</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- <Pagination :pagination="categories.links"></Pagination> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    </div>
</template>
<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import {
        Head
    } from '@inertiajs/vue3';

    defineProps({
        orders: [Object, Array]
    });
</script>
