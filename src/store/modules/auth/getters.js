export function user (state) {
  return state.user
}

export function verifyParam (state) {
  return state.verify
}

export const check = state => roles => {
  const user = state.user
  if (user) {
    if (Array.isArray(roles) && roles.length) {
      for (let role of roles) {
        if (!user.roles.includes(role)) {
          return false
        }
      }
    } else if (roles) {
      if (!user.roles.includes(roles)) {
        return false
      }
    }

    return true
  }

  return false
}