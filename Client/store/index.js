export const state = ()=>({
    selectedCart: null,
   selectedSum:0,
   usedPoints: 0,
})

export const mutations = {

    setCart(state,cart){
        state.selectedCart = cart
    },

    setTotal(state,total){
        state.selectedSum = total
    },

    setPoints(state,points){
        state.usedPoints = points
    },

    
}

export const getters = {
    getCart(state){
        return state.selectedCart
    },

    getTotal(state){
        return state.selectedSum
    },

    getPoints(state){
        return state.usedPoints
    }

    
}